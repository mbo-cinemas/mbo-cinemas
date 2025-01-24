class Movie {
    constructor({ id, title, genre, rating, duration, description, locations, times, imageUrl }) {
        this.id = id;
        this.title = title;
        this.genre = genre;
        this.rating = rating;
        this.duration = duration;
        this.description = description;
        this.locations = locations;
        this.times = times;
        this.imageUrl = imageUrl;
    }

    render() {
        return `
            <article class="movie-card">
                <article class="movie-poster">
                    <img src="${this.imageUrl}" alt="${this.title}">
                </article>
                <article class="movie-info">
                    <h3 class="movie-title">${this.title}</h3>
                    <article class="movie-meta">
                        <span class="rating">⭐ ${this.rating}</span>
                        <span>${this.duration}</span>
                    </article>
                    <p class="movie-description">${this.description}</p>
                    <div class="show-times">
                        ${this.times.split(',').map(time => `<span class="time-slot">${time.trim()}</span>`).join('')}
                    </div>
                    <button class="book-btn" data-movie-id="${this.id}">Boek Nu</button>
                </article>
            </article>
        `;
    }
}

class MovieApp {
    constructor() {
        this.movies = [];
        this.filteredMovies = [];
        this.init();
    }

    async init() {
        await this.fetchMovies();
        this.setupFilters();
        this.setupEventListeners();
    }

    async fetchMovies() {
        try {
            const response = await fetch('fetch_movies.php');
            const data = await response.json();
            
            if (data.error) throw new Error(data.error);
            
            this.movies = data.map(movie => new Movie(movie));
            this.filteredMovies = [...this.movies];
            this.renderMovies();
            
        } catch (error) {
            console.error('Error fetching movies:', error);
            this.showFeedback('Fout bij laden films', 'error');
        }
    }

    renderMovies() {
        const grid = document.getElementById('movieGrid');
        grid.innerHTML = '';
        this.filteredMovies.forEach(movie => {
            grid.insertAdjacentHTML('beforeend', movie.render());
        });
    }

    setupFilters() {
        document.getElementById('searchInput').addEventListener('input', () => this.filterMovies());
        document.getElementById('genreFilter').addEventListener('change', () => this.filterMovies());
        document.getElementById('locationFilter').addEventListener('change', () => this.filterMovies());
    }

    filterMovies() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const genre = document.getElementById('genreFilter').value.toLowerCase();
        const location = document.getElementById('locationFilter').value.toLowerCase();

        this.filteredMovies = this.movies.filter(movie => {
            const matchesSearch = movie.title.toLowerCase().includes(searchTerm) || 
                                movie.description.toLowerCase().includes(searchTerm);
            const matchesGenre = genre === 'all' || movie.genre.toLowerCase() === genre;
            const matchesLocation = location === 'all' || 
                                  movie.locations.toLowerCase().includes(location);
            
            return matchesSearch && matchesGenre && matchesLocation;
        });

        this.renderMovies();
    }

    setupEventListeners() {
        // Booking functionality
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('book-btn')) {
                this.handleBooking(e.target.dataset.movieId);
            }
        });
    }

    handleBooking(movieId) {
        const movie = this.movies.find(m => m.id == movieId);
        this.showFeedback(`Booking gestart voor: ${movie.title}`, 'success');
        // Voeg hier booking logica toe
    }

    showFeedback(message, type = 'info') {
        const feedback = document.createElement('div');
        feedback.className = `feedback ${type}`;
        feedback.textContent = message;
        
        document.body.appendChild(feedback);
        setTimeout(() => feedback.remove(), 3000);
    }
}

// Form Validation & localStorage
document.addEventListener('DOMContentLoaded', () => {
    // Initialize Movie App
    new MovieApp();

    // Form handling
    document.querySelectorAll('form').forEach(form => {
        // Restore form data
        const savedData = JSON.parse(localStorage.getItem(form.id));
        if (savedData) {
            Object.entries(savedData).forEach(([name, value]) => {
                const input = form.querySelector(`[name="${name}"]`);
                if (input) input.value = value;
            });
        }

        // Real-time validation
        form.querySelectorAll('input, textarea').forEach(input => {
            input.addEventListener('input', function() {
                validateField(this);
                saveFormState(form);
            });
        });

        // Submit handling
        form.addEventListener('submit', function(e) {
            let isValid = true;
            form.querySelectorAll('[required]').forEach(input => {
                if (!validateField(input)) isValid = false;
            });

            if (!isValid) {
                e.preventDefault();
                showFeedback('Corrigeer de gemarkeerde velden', 'error');
            } else {
                localStorage.removeItem(form.id);
            }
        });
    });

    function validateField(field) {
        let isValid = true;
        const value = field.value.trim();

        // Required check
        if (field.required && !value) isValid = false;

        // Email validation
        if (field.type === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
            isValid = false;
        }

        // Password match
        if (field.name === 'confirm_password') {
            const password = field.form.querySelector('[name="password"]').value;
            if (value !== password) isValid = false;
        }

        // Visual feedback
        field.style.borderColor = isValid ? '' : '#e50914';
        return isValid;
    }

    function saveFormState(form) {
        const data = {};
        form.querySelectorAll('input, textarea').forEach(input => {
            data[input.name] = input.value;
        });
        localStorage.setItem(form.id, JSON.stringify(data));
    }

    function showFeedback(message, type) {
        const feedback = document.createElement('div');
        feedback.className = `feedback ${type}`;
        feedback.textContent = message;
        document.body.appendChild(feedback);
        setTimeout(() => feedback.remove(), 3000);
    }
});