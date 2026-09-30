const http = require('http');

const urls = [
  'http://raktainfotech.local/',
  'http://raktainfotech.local/about/',
  'http://raktainfotech.local/services/',
  'http://raktainfotech.local/portfolio/',
  'http://raktainfotech.local/contact/',
  'http://raktainfotech.local/blog/'
];

async function checkUrl(url) {
  return new Promise((resolve) => {
    http.get(url, (res) => {
      let data = '';
      res.on('data', chunk => data += chunk);
      res.on('end', () => {
        // Extract title
        const titleMatch = data.match(/<title>([^<]*)<\/title>/i);
        const title = titleMatch ? titleMatch[1] : 'No Title';

        // Check for PHP errors / warnings
        const warnings = [];
        const matches = data.match(/<b>(Warning|Fatal error|Notice)<\/b>:[^<]*/gi) || [];
        matches.forEach(m => warnings.push(m.replace(/<[^>]*>/g, '')));

        // Check for elementor
        const isElementor = data.includes('elementor-section') || data.includes('rakta_hero_3d');

        // Check nav links in HTML
        const links = [];
        const linkMatches = data.matchAll(/<a\s+(?:[^>]*?\s+)?href=(["'])(.*?)\1/gi);
        for (const lm of linkMatches) {
          if (!lm[2].startsWith('#') && !lm[2].includes('wp-admin') && !lm[2].includes('javascript')) {
            links.push(lm[2]);
          }
        }

        resolve({
          url,
          statusCode: res.statusCode,
          title,
          warnings,
          isElementor,
          dataLength: data.length,
          navLinksSample: [...new Set(links)].slice(0, 10)
        });
      });
    }).on('error', (err) => {
      resolve({ url, error: err.message });
    });
  });
}

async function run() {
  console.log('Testing connection to raktainfotech.local...');
  for (const u of urls) {
    const res = await checkUrl(u);
    console.log('\n--- ' + u + ' ---');
    if (res.error) {
      console.log('ERROR:', res.error);
    } else {
      console.log('Status:', res.statusCode);
      console.log('Title:', res.title);
      console.log('Elementor Detected:', res.isElementor);
      console.log('Warnings/Errors:', res.warnings.length > 0 ? res.warnings : 'None');
      console.log('Page Links:', res.navLinksSample);
    }
  }
}

run();
