

        function showModal(modalId) {
            document.querySelectorAll('.modal').forEach(modal => modal.classList.remove('active'));
            document.getElementById(modalId).classList.add('active');
            document.getElementById('backdrop').classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
            document.getElementById('backdrop').classList.remove('active');
        }

        function toggleCategory(categoryId) {
            const content = document.getElementById(categoryId);
            content.classList.toggle('active');
        }

        function searchFAQs() {
            const query = document.getElementById('faq-search').value.toLowerCase();
            const faqItems = document.querySelectorAll('.faq-item');
            const categories = document.querySelectorAll('.faq-category');
            const categoryContents = document.querySelectorAll('.faq-content');

            faqItems.forEach(item => item.classList.remove('hidden'));
            categories.forEach(category => category.classList.remove('hidden'));
            categoryContents.forEach(content => content.classList.remove('active'));

            if (query.trim() === '') {
                return;
            }

            let anyMatches = false;

            faqItems.forEach(item => {
                const questionText = item.querySelector('h3').textContent.toLowerCase();
                const modalId = item.getAttribute('onclick').match(/'modal\d+'/)[0].replace(/'/g, '');
                const modalText = document.getElementById(modalId).querySelector('p').textContent.toLowerCase();
                const isMatch = questionText.includes(query) || modalText.includes(query);

                if (isMatch) {
                    anyMatches = true;
                    item.classList.remove('hidden');
                    const categoryContent = item.closest('.faq-content');
                    categoryContent.classList.add('active');
                    categoryContent.closest('.faq-category').classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });

            categories.forEach(category => {
                const visibleItems = category.querySelectorAll('.faq-item:not(.hidden)').length;
                if (visibleItems === 0) {
                    category.classList.add('hidden');
                }
            });
        }

        document.getElementById('backdrop').addEventListener('click', () => {
            document.querySelectorAll('.modal').forEach(modal => modal.classList.remove('active'));
            document.getElementById('backdrop').classList.remove('active');
        });
  