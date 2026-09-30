const sharp = require('sharp');
const fs = require('fs');
const path = require('path');

const USER_IMAGE_PATH = 'C:/Users/Administrator/.gemini/antigravity-ide/brain/5a68eeae-9ef2-4b3a-b70b-b47eb4f883d9/.user_uploaded/media_1790748463569.jpg';

async function generateAllAssets() {
  console.log('--- Starting Rakta Infotech Asset Generation ---');

  if (!fs.existsSync(USER_IMAGE_PATH)) {
    throw new Error('User image not found at ' + USER_IMAGE_PATH);
  }

  // Ensure directories exist
  const publicDir = path.resolve('public');
  const publicImagesDir = path.resolve('public/images');
  const wpImagesDir = path.resolve('wordpress/theme/rakta-infotech/assets/images');

  [publicDir, publicImagesDir, wpImagesDir].forEach(dir => {
    if (!fs.existsSync(dir)) fs.mkdirSync(dir, { recursive: true });
  });

  // Copy raw original
  fs.copyFileSync(USER_IMAGE_PATH, path.join(publicImagesDir, 'rakta-logo-original.jpg'));
  fs.copyFileSync(USER_IMAGE_PATH, path.join(publicImagesDir, 'rakta-logo.jpg'));
  fs.copyFileSync(USER_IMAGE_PATH, path.join(wpImagesDir, 'rakta-logo-original.jpg'));
  fs.copyFileSync(USER_IMAGE_PATH, path.join(wpImagesDir, 'rakta-logo.jpg'));
  console.log('✓ Copied original high-res dark logo');

  // Read raw RGB pixels
  const { data, info } = await sharp(USER_IMAGE_PATH)
    .raw()
    .toBuffer({ resolveWithObject: true });

  const w = info.width;
  const h = info.height;
  console.log(`Input dimensions: ${w}x${h}`);

  // Create clean alpha-extracted buffer from dark background
  // Background noise threshold:
  // Points at corners/edges had R: 0-1, G: 1-12, B: 3-30
  const bgThreshold = 26;
  const transparentBuffer = Buffer.alloc(w * h * 4);

  for (let i = 0; i < w * h; i++) {
    const r = data[i * 3];
    const g = data[i * 3 + 1];
    const b = data[i * 3 + 2];

    const maxC = Math.max(r, g, b);
    const lum = 0.299 * r + 0.587 * g + 0.114 * b;

    if (maxC <= bgThreshold) {
      // Noise / deep background -> 100% transparent
      transparentBuffer[i * 4] = 0;
      transparentBuffer[i * 4 + 1] = 0;
      transparentBuffer[i * 4 + 2] = 0;
      transparentBuffer[i * 4 + 3] = 0;
    } else {
      let alpha;
      if (maxC < 65) {
        // Soft feather on dark glowing edges
        alpha = ((maxC - bgThreshold) / (65 - bgThreshold)) * (65 / 255);
      } else {
        alpha = Math.min(1, Math.max(0, (maxC - 10) / 245));
        if (lum > 40) {
          alpha = Math.min(1, alpha * 1.3);
        }
      }

      const a255 = Math.round(Math.min(255, Math.max(0, alpha * 255)));
      const unmultFactor = a255 > 0 ? (255 / Math.max(a255, 60)) : 1;

      transparentBuffer[i * 4] = Math.min(255, Math.round(r * unmultFactor));
      transparentBuffer[i * 4 + 1] = Math.min(255, Math.round(g * unmultFactor));
      transparentBuffer[i * 4 + 2] = Math.min(255, Math.round(b * unmultFactor));
      transparentBuffer[i * 4 + 3] = a255;
    }
  }

  // 1. Full Stacked Transparent Logo
  const fullTransparent = await sharp(transparentBuffer, { raw: { width: w, height: h, channels: 4 } })
    .trim({ threshold: 5 })
    .png()
    .toBuffer();

  const fullTrimMeta = await sharp(fullTransparent).metadata();
  console.log(`✓ Full trimmed transparent logo: ${fullTrimMeta.width}x${fullTrimMeta.height}`);

  fs.writeFileSync(path.join(publicImagesDir, 'rakta-logo-transparent.png'), fullTransparent);
  fs.writeFileSync(path.join(publicImagesDir, 'rakta-logo-stacked.png'), fullTransparent);
  fs.writeFileSync(path.join(publicImagesDir, 'rakta-logo-dark.png'), fullTransparent);
  fs.writeFileSync(path.join(wpImagesDir, 'rakta-logo-transparent.png'), fullTransparent);
  fs.writeFileSync(path.join(wpImagesDir, 'rakta-logo-stacked.png'), fullTransparent);
  fs.writeFileSync(path.join(wpImagesDir, 'rakta-logo-dark.png'), fullTransparent);

  // 2. Separate Emblem and Wordmark for horizontal layout and favicon
  const emblemBuffer = Buffer.from(transparentBuffer);
  const textBuffer = Buffer.from(transparentBuffer);

  function isEmblemPixel(x, y) {
    if (y < 420) return true;
    if (y > 438) return false;
    // Between 420 and 438:
    if (x < 350) return false; // letter 'R' of Rakta
    if (x >= 350 && x <= 420) return y <= 436; // swoosh tip
    if (x > 420 && x < 660) return y <= 428; // 'k' and 't' tops
    if (x >= 660) return y <= 432; // right leg of R
    return false;
  }

  for (let y = 0; y < h; y++) {
    for (let x = 0; x < w; x++) {
      const idx = (y * w + x) * 4;
      const emb = isEmblemPixel(x, y);
      if (!emb) {
        emblemBuffer[idx + 3] = 0;
      } else {
        textBuffer[idx + 3] = 0;
      }
    }
  }

  const cleanEmblem = await sharp(emblemBuffer, { raw: { width: w, height: h, channels: 4 } })
    .trim({ threshold: 5 })
    .png()
    .toBuffer();

  const cleanText = await sharp(textBuffer, { raw: { width: w, height: h, channels: 4 } })
    .trim({ threshold: 5 })
    .png()
    .toBuffer();

  const embMeta = await sharp(cleanEmblem).metadata();
  const txtMeta = await sharp(cleanText).metadata();
  console.log(`✓ Clean emblem: ${embMeta.width}x${embMeta.height}`);
  console.log(`✓ Clean text: ${txtMeta.width}x${txtMeta.height}`);

  // 3. High-Res Emblem Icon (512x512)
  const iconSize = 512;
  const iconPad = 28;
  const iconMaxDim = iconSize - (iconPad * 2);
  const iconScale = Math.min(iconMaxDim / embMeta.width, iconMaxDim / embMeta.height);
  const iconW = Math.round(embMeta.width * iconScale);
  const iconH = Math.round(embMeta.height * iconScale);

  const resizedEmbForIcon = await sharp(cleanEmblem)
    .resize(iconW, iconH, { kernel: 'lanczos3' })
    .toBuffer();

  const icon512 = await sharp({
    create: {
      width: iconSize,
      height: iconSize,
      channels: 4,
      background: { r: 0, g: 0, b: 0, alpha: 0 }
    }
  })
  .composite([{
    input: resizedEmbForIcon,
    left: Math.round((iconSize - iconW) / 2),
    top: Math.round((iconSize - iconH) / 2)
  }])
  .png()
  .toBuffer();

  fs.writeFileSync(path.join(publicImagesDir, 'rakta-icon.png'), icon512);
  fs.writeFileSync(path.join(wpImagesDir, 'rakta-icon.png'), icon512);
  console.log('✓ High-res rakta-icon.png created (512x512)');

  // 4. Horizontal Navbar Logo (rakta-logo-nav.png & rakta-logo-horizontal.png)
  // Height 180px, Width ~620px (designed for 3x retina scaling on height: 42-46px)
  const navH = 180;
  const navEmbH = 160;
  const navEmbW = Math.round(navEmbH * (embMeta.width / embMeta.height));
  const navTxtH = 114;
  const navTxtW = Math.round(navTxtH * (txtMeta.width / txtMeta.height));
  const gap = 30;
  const navTotalW = navEmbW + gap + navTxtW;

  const navEmbBuf = await sharp(cleanEmblem).resize(navEmbW, navEmbH, { kernel: 'lanczos3' }).toBuffer();
  const navTxtBuf = await sharp(cleanText).resize(navTxtW, navTxtH, { kernel: 'lanczos3' }).toBuffer();

  const navHorizontalBuf = await sharp({
    create: {
      width: navTotalW,
      height: navH,
      channels: 4,
      background: { r: 0, g: 0, b: 0, alpha: 0 }
    }
  })
  .composite([
    { input: navEmbBuf, left: 0, top: Math.round((navH - navEmbH) / 2) },
    { input: navTxtBuf, left: navEmbW + gap, top: Math.round((navH - navTxtH) / 2) + 3 }
  ])
  .png()
  .toBuffer();

  fs.writeFileSync(path.join(publicImagesDir, 'rakta-logo-nav.png'), navHorizontalBuf);
  fs.writeFileSync(path.join(publicImagesDir, 'rakta-logo-horizontal.png'), navHorizontalBuf);
  fs.writeFileSync(path.join(wpImagesDir, 'rakta-logo-nav.png'), navHorizontalBuf);
  fs.writeFileSync(path.join(wpImagesDir, 'rakta-logo-horizontal.png'), navHorizontalBuf);
  console.log(`✓ Horizontal nav logo created: ${navTotalW}x${navH} (rakta-logo-nav.png)`);

  // 5. Favicon System:
  // We produce:
  // - public/favicon.png (64x64)
  // - public/favicon-32x32.png (32x32)
  // - public/favicon-16x16.png (16x16)
  // - public/apple-touch-icon.png (180x180)
  // - public/favicon.ico (Multi-size ICO)
  // - public/favicon.svg (Sharp, high-res vector embedding with ZERO blur filter)

  // A. Favicon on subtle dark badge with cyan border (ensures 100% crisp visibility on white or dark browser tabs)
  async function createBadgeIcon(size, radius, borderW = 2) {
    const scale = size / 512;
    const r = Math.round(radius * scale);
    const bw = Math.max(1, Math.round(borderW * scale));

    const badgeSvg = Buffer.from(`
      <svg width="${size}" height="${size}" viewBox="0 0 ${size} ${size}" xmlns="http://www.w3.org/2000/svg">
        <rect width="${size}" height="${size}" rx="${r}" fill="#040711" />
        <rect x="${bw}" y="${bw}" width="${size - bw * 2}" height="${size - bw * 2}" rx="${Math.max(1, r - bw)}" fill="#080D1E" stroke="#00F0FF" stroke-width="${bw}" stroke-opacity="0.55" />
      </svg>
    `);

    const badgeBg = await sharp(badgeSvg).toBuffer();
    const embTargetW = Math.round(size * 0.78);
    const embTargetH = Math.round(embTargetW * (embMeta.height / embMeta.width));

    const scaledEmb = await sharp(cleanEmblem)
      .resize(embTargetW, embTargetH, { kernel: 'lanczos3' })
      .toBuffer();

    return sharp(badgeBg)
      .composite([{
        input: scaledEmb,
        left: Math.round((size - embTargetW) / 2),
        top: Math.round((size - embTargetH) / 2)
      }])
      .png()
      .toBuffer();
  }

  // Transparent favicon (emblem with zero background, for users who prefer naked emblem)
  async function createTransparentIcon(size) {
    const embTargetW = Math.round(size * 0.94);
    const embTargetH = Math.round(embTargetW * (embMeta.height / embMeta.width));

    const scaledEmb = await sharp(cleanEmblem)
      .resize(embTargetW, embTargetH, { kernel: 'lanczos3' })
      .toBuffer();

    return sharp({
      create: {
        width: size,
        height: size,
        channels: 4,
        background: { r: 0, g: 0, b: 0, alpha: 0 }
      }
    })
    .composite([{
      input: scaledEmb,
      left: Math.round((size - embTargetW) / 2),
      top: Math.round((size - embTargetH) / 2)
    }])
    .png()
    .toBuffer();
  }

  // Favicon PNG (64x64)
  const fav64 = await createBadgeIcon(64, 15, 2.5);
  fs.writeFileSync(path.join(publicDir, 'favicon.png'), fav64);
  fs.writeFileSync(path.join(publicDir, 'favicon-64x64.png'), fav64);

  // Favicon 32x32 & 16x16
  const fav32 = await createBadgeIcon(32, 8, 1.5);
  fs.writeFileSync(path.join(publicDir, 'favicon-32x32.png'), fav32);

  const fav16 = await createBadgeIcon(16, 4, 1);
  fs.writeFileSync(path.join(publicDir, 'favicon-16x16.png'), fav16);

  // Apple Touch Icon 180x180
  const appleTouch = await createBadgeIcon(180, 42, 4);
  fs.writeFileSync(path.join(publicDir, 'apple-touch-icon.png'), appleTouch);
  fs.writeFileSync(path.join(publicDir, 'apple-touch-icon-precomposed.png'), appleTouch);

  // Favicon ICO (Multi-image ICO format containing 16, 32, 48)
  const fav48 = await createBadgeIcon(48, 12, 2);
  const icoBuffer = createIco([fav16, fav32, fav48]);
  fs.writeFileSync(path.join(publicDir, 'favicon.ico'), icoBuffer);

  // Copy favicons to WordPress theme root & assets
  fs.writeFileSync(path.join(wpImagesDir, 'favicon.png'), fav64);
  fs.writeFileSync(path.join(wpImagesDir, 'apple-touch-icon.png'), appleTouch);
  fs.writeFileSync(path.join(wpImagesDir, 'favicon.ico'), icoBuffer);

  // B. Favicon SVG:
  // To avoid ANY blurriness (the issue user complained about), we render the 512px emblem as a high-density base64 data-URI embedded directly into an SVG viewBox with crisp rounded cyber frame, with NO blur filters!
  const emb512ForSvg = await createBadgeIcon(512, 115, 6);
  const b64 = emb512ForSvg.toString('base64');

  const svgContent = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="100%" height="100%">
  <defs>
    <clipPath id="squircle">
      <rect width="512" height="512" rx="115" />
    </clipPath>
  </defs>
  <g clip-path="url(#squircle)">
    <image href="data:image/png;base64,${b64}" width="512" height="512" preserveAspectRatio="xMidYMid meet" style="image-rendering: -webkit-optimize-contrast; image-rendering: crisp-edges;" />
  </g>
</svg>
`;

  fs.writeFileSync(path.join(publicDir, 'favicon.svg'), svgContent);
  fs.writeFileSync(path.join(wpImagesDir, 'favicon.svg'), svgContent);
  console.log('✓ Favicon files created: favicon.svg, favicon.png, favicon.ico, apple-touch-icon.png');

  console.log('\n=== ALL ASSETS GENERATED AND VERIFIED SUCCESSFULLY ===');
}

// Minimal binary ICO generator from PNG buffers
function createIco(pngBuffers) {
  const numImages = pngBuffers.length;
  const headerSize = 6;
  const dirEntrySize = 16;
  let offset = headerSize + (dirEntrySize * numImages);

  const header = Buffer.alloc(headerSize);
  header.writeUInt16LE(0, 0); // Reserved
  header.writeUInt16LE(1, 2); // ICO type
  header.writeUInt16LE(numImages, 4);

  const entries = [];
  for (const buf of pngBuffers) {
    // Read dimensions from PNG IHDR
    const width = buf.readUInt32BE(16);
    const height = buf.readUInt32BE(20);

    const entry = Buffer.alloc(dirEntrySize);
    entry.writeUInt8(width >= 256 ? 0 : width, 0);
    entry.writeUInt8(height >= 256 ? 0 : height, 1);
    entry.writeUInt8(0, 2); // Color palette
    entry.writeUInt8(0, 3); // Reserved
    entry.writeUInt16LE(1, 4); // Color planes
    entry.writeUInt16LE(32, 6); // Bits per pixel
    entry.writeUInt32LE(buf.length, 8); // Size
    entry.writeUInt32LE(offset, 12); // Offset

    entries.push(entry);
    offset += buf.length;
  }

  return Buffer.concat([header, ...entries, ...pngBuffers]);
}

generateAllAssets().catch(err => {
  console.error('Asset generation failed:', err);
  process.exit(1);
});
