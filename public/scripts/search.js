document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const searchSuggestions = document.getElementById('searchSuggestions');
    const suggestionsLoading = document.getElementById('suggestionsLoading');
    const suggestionsList = document.getElementById('suggestionsList');
    let debounceTimer;
  
    // Function to fetch search results
    async function fetchSearchResults(query) {
      if (query.length < 2) {
        searchSuggestions.classList.add('hidden');
        return;
      }
  
      suggestionsLoading.classList.remove('hidden');
      searchSuggestions.classList.remove('hidden');
  
      try {
        const response = await fetch(`/search/threads?q=${encodeURIComponent(query)}`);
        const data = await response.json();
  
        suggestionsList.innerHTML = '';
  
        if (data.length === 0) {
          suggestionsList.innerHTML = `
            <div class="px-4 py-3 text-sm text-gray-500">
              No results found
            </div>
          `;
          return;
        }
  
        data.forEach(item => {
          const div = document.createElement('div');
          div.className = 'px-4 py-3 hover:bg-gray-50 cursor-pointer text-sm';
          div.innerHTML = `
            <div class="font-medium">${item.username}</div>
            <div class="text-gray-500 text-xs">${item.content.substring(0, 100)}...</div>
          `;
          div.addEventListener('click', () => {
            window.location.href = `/threads/${item.id}`;
          });
          suggestionsList.appendChild(div);
        });
      } catch (error) {
        console.error('Error fetching search results:', error);
      } finally {
        suggestionsLoading.classList.add('hidden');
      }
    }
  
    // Input event listener with debounce
    searchInput?.addEventListener('input', function() {
      clearTimeout(debounceTimer);
      debounceTimer = setTimeout(() => {
        fetchSearchResults(this.value.trim());
      }, 300);
    });
  
    // Close suggestions when clicking outside
    document.addEventListener('click', function(e) {
      if (!searchInput?.contains(e.target) && !searchSuggestions?.contains(e.target)) {
        searchSuggestions?.classList.add('hidden');
      }
    });
  
    // Show suggestions when focusing on search input
    searchInput?.addEventListener('focus', function() {
      if (this.value.trim().length >= 2) {
        searchSuggestions?.classList.remove('hidden');
      }
    });
  });
  