const fs = require('fs');
const path = require('path');

const targetFiles = [
  'wordpress/theme/rakta-infotech/inc/demo-data/page-home.json',
  'wordpress/theme/rakta-infotech/inc/demo-data/page-about.json',
  'wordpress/theme/rakta-infotech/inc/demo-data/page-services.json',
  'wordpress/theme/rakta-infotech/inc/demo-data/page-portfolio.json',
  'wordpress/theme/rakta-infotech/inc/demo-data/page-contact.json',
  'READY_TO_UPLOAD_WORDPRESS_PACKAGES/homepage-3d-elementor-template.json'
];

function sanitizeElements(elements) {
  if (!Array.isArray(elements)) return;

  for (const el of elements) {
    if (el.elType === 'column') {
      if (!el.settings || typeof el.settings !== 'object') {
        el.settings = {};
      }
      if (el.settings._column_size === undefined) {
        el.settings._column_size = 100;
      }
      if (el.settings._inline_size === undefined) {
        el.settings._inline_size = null;
      }
    }
    if (el.elements && Array.isArray(el.elements)) {
      sanitizeElements(el.elements);
    }
  }
}

targetFiles.forEach(fileRel => {
  const filePath = path.resolve(fileRel);
  if (!fs.existsSync(filePath)) {
    console.warn('File not found:', filePath);
    return;
  }

  const raw = fs.readFileSync(filePath, 'utf8');
  const data = JSON.parse(raw);

  if (Array.isArray(data.content)) {
    sanitizeElements(data.content);
  } else if (Array.isArray(data)) {
    sanitizeElements(data);
  }

  fs.writeFileSync(filePath, JSON.stringify(data, null, 2), 'utf8');
  console.log('Sanitized & updated:', fileRel);
});

console.log('All Elementor JSON templates successfully repaired with _column_size!');
