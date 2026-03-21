document.addEventListener('DOMContentLoaded', () => {
  const sortSelect = document.getElementById('store-sort');
  const searchToggle = document.querySelector('.header-search-toggle');
  const searchPanel = document.querySelector('.header-search-panel');

  if (sortSelect) {
    sortSelect.addEventListener('change', () => {
      const form = sortSelect.closest('form');
      if (form) {
        form.submit();
      }
    });
  }

  // Highlight active category in sidebar based on custom query param
  const params = new URLSearchParams(window.location.search);
  const activeCat = params.get('product_cat_filter');

  if (activeCat) {
    document.querySelectorAll('.product-category-list a').forEach((link) => {
      try {
        const url = new URL(link.href, window.location.origin);
        if (url.searchParams.get('product_cat_filter') === activeCat) {
          link.classList.add('is-active');
        }
      } catch (error) {
        // Ignore malformed URLs
      }
    });
  } else {
    const viewAllLink = document.querySelector('.view-all-categories');
    if (viewAllLink) {
      viewAllLink.classList.add('is-active');
    }
  }

  // Header search toggle
  if (searchToggle && searchPanel) {
    searchToggle.addEventListener('click', (event) => {
      event.preventDefault();

      const isHidden = searchPanel.hasAttribute('hidden');

      if (isHidden) {
        searchPanel.removeAttribute('hidden');
        searchToggle.setAttribute('aria-expanded', 'true');

        const input = searchPanel.querySelector('input');
        if (input) {
          input.focus();
        }
      } else {
        searchPanel.setAttribute('hidden', '');
        searchToggle.setAttribute('aria-expanded', 'false');
      }
    });

    document.addEventListener('click', (event) => {
      const clickedInsidePanel = searchPanel.contains(event.target);
      const clickedToggle = searchToggle.contains(event.target);

      if (!clickedInsidePanel && !clickedToggle) {
        searchPanel.setAttribute('hidden', '');
        searchToggle.setAttribute('aria-expanded', 'false');
      }
    });

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') {
        searchPanel.setAttribute('hidden', '');
        searchToggle.setAttribute('aria-expanded', 'false');
      }
    });
  }
});