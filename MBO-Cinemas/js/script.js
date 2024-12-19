class Movie {
    constructor({ id, title, genre, rating, duration, description, locations, times, trailerUrl, imageUrl }) {
        this.id = id;
        this.title = title;
        this.genre = genre;
        this.rating = rating;
        this.duration = duration;
        this.description = description;
        this.locations = locations;
        this.times = times;
        this.trailerUrl = trailerUrl;
        this.imageUrl = imageUrl;
    }

    render() {
        return `
            <div class="movie-card">
                <div class="movie-poster-wrapper">
                    <img src="${this.imageUrl || 'https://via.placeholder.com/300x450?text=No+Image'}" alt="${this.title} Poster">
                </div>
                <div class="movie-details">
                    <h3 class="movie-title">${this.title}</h3>
                    <div class="movie-rating">★ ${this.rating}</div>
                    <p class="movie-meta">${this.genre} | ${this.duration}</p>
                    <p class="movie-description">${this.description}</p>
                    <div class="show-times">
                        ${this.times.map(time => `<span class="time-slot">${time}</span>`).join('')}
                    </div>
                    <a href="#" class="booking-button" data-movie-id="${this.id}">Book Now</a>
                </div>
            </div>
        `;
    }
}

class MovieApp {
    constructor(movies) {
        this.movies = movies.map(movieData => new Movie(movieData));
        this.filteredMovies = [...this.movies];
        this.init();
    }

    init() {
        this.renderMovies();
        this.setupFilters();
        this.setupSearch();
    }

    renderMovies() {
        const grid = document.getElementById('movieGrid');
        grid.innerHTML = '';
        this.filteredMovies.forEach(movie => {
            const movieCard = document.createElement('div');
            movieCard.innerHTML = movie.render();
            grid.appendChild(movieCard);
        });
    }

    setupFilters() {
        const genreFilter = document.getElementById('genreFilter');
        const locationFilter = document.getElementById('locationFilter');
        const dateFilter = document.getElementById('dateFilter');

        [genreFilter, locationFilter, dateFilter].forEach(filter => {
            filter.addEventListener('change', () => this.filterMovies());
        });
    }

    setupSearch() {
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', () => this.filterMovies());
    }

    filterMovies() {
        const genre = document.getElementById('genreFilter').value.toLowerCase();
        const location = document.getElementById('locationFilter').value.toLowerCase();
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();

        this.filteredMovies = this.movies.filter(movie => {
            const genreMatch = genre === 'all' || movie.genre.toLowerCase().includes(genre);
            const locationMatch = location === 'all' || movie.locations.includes(location);
            const searchMatch = searchTerm === '' || movie.title.toLowerCase().includes(searchTerm) || movie.description.toLowerCase().includes(searchTerm);
            return genreMatch && locationMatch && searchMatch;
        });

        this.renderMovies();
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const allMovies = [
        {
            id: 1,
            title: "Inside Out 2",
            genre: "Animation",
            rating: 4.4,
            duration: "1h 40m",
            description: "Riley is a teenager now, and her emotions are more complicated than ever.",
            locations: ["amsterdam", "den-haag"],
            times: ["10:15", "12:30", "15:00", "17:15"],
            imageUrl: "../MBO-Cinemas/images/inside out 2 image.jpg",
        },
        {
            id: 2,
            title: "Furiosa: A Mad Max Saga",
            genre: "Action",
            rating: 4.8,
            duration: "2h 15m",
            description: "The origin story of the mighty warrior Furiosa.",
            locations: ["den-haag", "amsterdam"],
            times: ["11:00", "14:00", "17:00", "20:00"],
            imageUrl: "../MBO-Cinemas/images/furiosa image.jpg",
        },
        {
            id: 3,
            title: "The Tall Guy",
            genre: "Comedy",
            rating: 4.2,
            duration: "1h 55m",
            description: "A heartwarming comedy about an unusually tall man finding his way in life.",
            locations: ["rotterdam", "utrecht"],
            times: ["13:30", "16:00", "18:30", "21:00"],
            imageUrl: "../MBO-Cinemas/images/the tall guy.jpg",
        },
        {
            id: 4,
            title: "Kingdom of the Planet of the Apes",
            genre: "Sci-Fi",
            rating: 4.6,
            duration: "2h 25m",
            description: "The next chapter in the Planet of the Apes saga.",
            locations: ["amsterdam", "rotterdam"],
            times: ["12:00", "15:30", "19:00", "22:00"],
            imageUrl: "../MBO-Cinemas/images/kingdom of apes image.jpg",
        }
    ];

    new MovieApp(allMovies);
});
