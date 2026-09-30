const sharp = require('sharp');
const fs = require('fs');

async function processLogo() {
  const { data, info } = await sharp('public/images/rakta-logo.jpg')
    .ensureAlpha()
    .raw()
    .toBuffer({ resolveWithObject: true });

  const { width, height } = info;
  console.log(`Original dimensions: ${width}x${height}`);

  // Inspect border pixels
  let cornerAvg = 0;
  for (let i = 0; i < 100; i++) {
    const idx = i * 4;
    cornerAvg += (data[idx] + data[idx+1] + data[idx+2]) / 3;
  }
  cornerAvg /= 100;
  console.log(`Top-left corner average brightness: ${cornerAvg}`);

  // Create a transparent version by removing the light background.
  // The background is near-white with subtle texture (around ~240-255).
  // The logo elements are blue (high B, low R), cyan, metallic grey/silver, and dark text.
  // We can calculate alpha based on distance from the white/off-white background.
  const transparentBuffer = Buffer.from(data);
  for (let i = 0; i < transparentBuffer.length; i += 4) {
    const r = transparentBuffer[i];
    const g = transparentBuffer[i + 1];
    const b = transparentBuffer[i + 2];

    // Background is near white (r,g,b all > 230 and closely matching).
    // Subtle gradient/texture might have r,g,b around 225-255.
    const brightness = (r * 0.299 + g * 0.587 + b * 0.114);
    const maxDiff = Math.max(Math.abs(r - g), Math.abs(g - b), Math.abs(b - r));

    if (brightness > 238 && maxDiff < 18) {
      // Near-white neutral background -> fully transparent
      transparentBuffer[i + 3] = 0;
    } else if (brightness > 215 && maxDiff < 25) {
      // Soft transition edge feathering
      const alphaFactor = 1 - (brightness - 215) / (238 - 215);
      transparentBuffer[i + 3] = Math.round(Math.min(255, Math.max(0, alphaFactor * 255)));
    }
  }

  // Save full transparent version
  await sharp(transparentBuffer, { raw: { width, height, channels: 4 } })
    .trim({ threshold: 10 })
    .png()
    .toFile('public/images/rakta-logo-transparent.png');
  
  console.log('Saved public/images/rakta-logo-transparent.png');

  const trimmed = await sharp('public/images/rakta-logo-transparent.png').metadata();
  console.log(`Trimmed dimensions: ${trimmed.width}x${trimmed.height}`);

  // Create an emblem-only version (3D 'R' with voxel blocks and swoosh)
  const iconHeight = Math.round(trimmed.height * 0.69);
  await sharp('public/images/rakta-logo-transparent.png')
    .extract({
      left: 0,
      top: 0,
      width: trimmed.width,
      height: iconHeight
    })
    .trim({ threshold: 5 })
    .png()
    .toFile('public/images/rakta-icon.png');

  // Create a dark-theme enhanced version of the full logo:
  // In the bottom portion (wordmark "Rakta INFOTECH"), brighten dark pixels so it looks brilliant on dark backgrounds
  const fullRaw = await sharp('public/images/rakta-logo-transparent.png')
    .raw()
    .toBuffer({ resolveWithObject: true });

  const darkBuffer = Buffer.from(fullRaw.data);
  const textSplitY = Math.round(fullRaw.info.height * 0.68);

  for (let y = 0; y < fullRaw.info.height; y++) {
    for (let x = 0; x < fullRaw.info.width; x++) {
      const idx = (y * fullRaw.info.width + x) * 4;
      const alpha = darkBuffer[idx + 3];
      if (alpha === 0) continue;

      if (y >= textSplitY) {
        const r = darkBuffer[idx];
        const g = darkBuffer[idx + 1];
        const b = darkBuffer[idx + 2];
        const lum = 0.299 * r + 0.587 * g + 0.114 * b;

        // If it's the cyan triangle in the 'A', keep it vibrant cyan
        const isCyan = (b > 180 && g > 150 && r < 100);
        if (!isCyan) {
          // If it's dark text, brighten it to silver-white / metallic glow
          if (lum < 160) {
            const factor = 1 - (lum / 160);
            darkBuffer[idx] = Math.min(255, Math.round(r + 210 * factor));
            darkBuffer[idx + 1] = Math.min(255, Math.round(g + 225 * factor));
            darkBuffer[idx + 2] = Math.min(255, Math.round(b + 245 * factor));
          }
        }
      }
    }
  }

  await sharp(darkBuffer, { raw: { width: fullRaw.info.width, height: fullRaw.info.height, channels: 4 } })
    .png()
    .toFile('public/images/rakta-logo-dark.png');

  // Optimized horizontal navbar logo
  await sharp('public/images/rakta-logo-dark.png')
    .resize({ height: 48, fit: 'inside' })
    .png()
    .toFile('public/images/rakta-logo-nav.png');

  // Optimized favicon
  await sharp('public/images/rakta-icon.png')
    .resize(64, 64, { fit: 'contain', background: { r: 0, g: 0, b: 0, alpha: 0 } })
    .png()
    .toFile('public/favicon.png');

  console.log('All optimized logo variants created successfully!');
}

processLogo().catch(console.error);
