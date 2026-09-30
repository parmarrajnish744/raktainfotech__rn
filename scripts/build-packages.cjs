const { execSync } = require('child_process');
const fs = require('fs');
const path = require('path');

const rootDir = path.resolve(__dirname, '..');
const packagesDir = path.join(rootDir, 'READY_TO_UPLOAD_WORDPRESS_PACKAGES');

if (!fs.existsSync(packagesDir)) {
  fs.mkdirSync(packagesDir, { recursive: true });
}

console.log('Building WordPress packages...');

function createZip(sourceDir, zipName, folderInZip) {
  const tempStage = path.join(rootDir, 'temp_stage_' + folderInZip);
  if (fs.existsSync(tempStage)) {
    fs.rmSync(tempStage, { recursive: true, force: true });
  }
  fs.mkdirSync(path.join(tempStage, folderInZip), { recursive: true });

  // Copy directory contents into tempStage/folderInZip
  execSync(`powershell -Command "Copy-Item -Path '${sourceDir}/*' -Destination '${path.join(tempStage, folderInZip)}' -Recurse -Force"`);

  const destRootZip = path.join(rootDir, zipName);
  const destPackageZip = path.join(packagesDir, zipName);

  if (fs.existsSync(destRootZip)) fs.unlinkSync(destRootZip);
  if (fs.existsSync(destPackageZip)) fs.unlinkSync(destPackageZip);

  // Compress tempStage into zip
  execSync(`powershell -Command "Add-Type -AssemblyName System.IO.Compression.FileSystem; [System.IO.Compression.ZipFile]::CreateFromDirectory('${tempStage}', '${destRootZip}', [System.IO.Compression.CompressionLevel]::Optimal, $false)"`);

  // Copy to READY_TO_UPLOAD_WORDPRESS_PACKAGES
  fs.copyFileSync(destRootZip, destPackageZip);

  // Clean up tempStage
  fs.rmSync(tempStage, { recursive: true, force: true });

  const stat = fs.statSync(destRootZip);
  console.log(`Created ${zipName}: ${(stat.size / 1024 / 1024).toFixed(2)} MB`);
}

// 1. Build Theme ZIP
createZip(
  path.join(rootDir, 'wordpress/theme/rakta-infotech'),
  'rakta-infotech.zip',
  'rakta-infotech'
);

// 2. Build Core Plugin ZIP
createZip(
  path.join(rootDir, 'wordpress/plugins/rakta-core'),
  'rakta-core.zip',
  'rakta-core'
);

// 3. Build 3D Engine Plugin ZIP
createZip(
  path.join(rootDir, 'wordpress/plugins/rakta-3d-engine'),
  'rakta-3d-engine.zip',
  'rakta-3d-engine'
);

console.log('All packages built successfully and synchronized to READY_TO_UPLOAD_WORDPRESS_PACKAGES!');

