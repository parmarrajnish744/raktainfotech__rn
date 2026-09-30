const http = require('http');

const pages = ['about', 'services', 'portfolio', 'contact', 'blog', '?pagename=services', '?pagename=portfolio'];

function fetchPage(slug) {
  return new Promise(resolve => {
    http.get('http://raktainfotech.local/' + (slug ? slug + '/' : ''), res => {
      let html = '';
      res.on('data', d => html += d);
      res.on('end', () => {
        const bodyMatch = html.match(/<body[^>]*class=["']([^"']*)["']/i);
        const bodyClasses = bodyMatch ? bodyMatch[1] : '';
        const h1Match = html.match(/<h1[^>]*>([\s\S]*?)<\/h1>/i);
        const h1 = h1Match ? h1Match[1].replace(/<[^>]*>/g, '').trim() : 'None';
        const isElementor = bodyClasses.includes('elementor-page') || html.includes('elementor-section');
        const isArchive = bodyClasses.includes('archive') || bodyClasses.includes('post-type-archive');
        const isPage = bodyClasses.includes('page-template') || bodyClasses.includes('page-id-');
        const canvas = html.includes('canvas') || html.includes('hero-3d-canvas') || html.includes('three-canvas');
        const navMatch = html.match(/<nav class="nav-desktop"[^>]*>([\s\S]*?)<\/nav>/i);
        const mobileNavMatch = html.match(/<nav class="mobile-nav-links"[^>]*>([\s\S]*?)<\/nav>/i);
        resolve({
          slug,
          status: res.statusCode,
          isElementor,
          isArchive,
          isPage,
          canvas,
          h1,
          navDesktop: navMatch ? navMatch[1].trim() : '',
          mobileNav: mobileNavMatch ? mobileNavMatch[1].trim() : '',
          bodyClasses: bodyClasses.split(' ').slice(0, 8).join(' ')
        });
      });
    }).on('error', err => resolve({ slug, error: err.message }));
  });
}

async function main() {
  console.log('--- Page Inspection ---');
  for (const p of ['', ...pages]) {
    const res = await fetchPage(p);
    console.log(`\nURL: /${p ? p + '/' : ''}`);
    console.log(`Status: ${res.status}`);
    console.log(`H1: ${res.h1}`);
    console.log(`Is Elementor: ${res.isElementor}`);
    console.log(`Is Archive: ${res.isArchive}`);
    console.log(`Is Page: ${res.isPage}`);
    console.log(`Has Canvas / 3D: ${res.canvas}`);
    console.log(`Classes: ${res.bodyClasses}`);
    if (p === '') {
      console.log(`\nNav Desktop HTML:\n${res.navDesktop}\n`);
      console.log(`Mobile Nav HTML:\n${res.mobileNav}\n`);
    }
  }
}

main();
