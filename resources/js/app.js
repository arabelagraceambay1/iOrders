document.addEventListener('DOMContentLoaded', function () {
    const overlay = document.getElementById('productDetailOverlay');
    const closeButton = document.getElementById('productDetailClose');
    const closeFooterButton = document.getElementById('productDetailCloseButton');
    const detailImage = document.getElementById('productDetailImage');
    const detailName = document.getElementById('productDetailName');
    const detailDescription = document.getElementById('productDetailDescription');
    const detailPrice = document.getElementById('productDetailPrice');
    const detailStock = document.getElementById('productDetailStock');
    const themeToggle = document.getElementById('themeToggle');
    const root = document.documentElement;

    function setTheme(theme) {
        const isDark = theme === 'dark';
        root.classList.toggle('dark-mode', isDark);
        localStorage.setItem('theme', theme);

        if (themeToggle) {
            themeToggle.innerHTML = isDark ? '☀️' : '🌙';
            themeToggle.setAttribute('aria-label', isDark ? 'Switch to light mode' : 'Switch to dark mode');
        }
    }

    function initializeTheme() {
        const savedTheme = localStorage.getItem('theme');
        const preferred = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        setTheme(savedTheme || preferred);
    }

    function openProductDetail(card) {
        const name = card.dataset.name || 'Product';
        const description = card.dataset.description || 'No description available.';
        const price = card.dataset.price || '₱0.00';
        const stock = card.dataset.stock || '0';
        const image = card.dataset.image || '';

        detailName.textContent = name;
        detailDescription.textContent = description;
        detailPrice.textContent = price;
        detailStock.textContent = stock;

        if (image) {
            detailImage.src = image;
            detailImage.style.display = 'block';
            detailImage.alt = name;
        } else {
            detailImage.style.display = 'none';
        }

        overlay.classList.add('active');
    }

    function closeProductDetail() {
        overlay.classList.remove('active');
    }

    document.querySelectorAll('.io-product-card-action').forEach(function (card) {
        card.addEventListener('click', function (event) {
            if (event.target.closest('form') || event.target.closest('button')) {
                return;
            }
            openProductDetail(card);
        });
    });

    if (closeButton) {
        closeButton.addEventListener('click', closeProductDetail);
    }
    if (closeFooterButton) {
        closeFooterButton.addEventListener('click', closeProductDetail);
    }
    if (overlay) {
        overlay.addEventListener('click', function (event) {
            if (event.target === overlay) {
                closeProductDetail();
            }
        });
    }
    if (themeToggle) {
        themeToggle.addEventListener('click', function () {
            const nextTheme = root.classList.contains('dark-mode') ? 'light' : 'dark';
            setTheme(nextTheme);
        });
    }

    initializeTheme();
});
