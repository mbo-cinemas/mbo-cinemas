<?php
require_once 'Database.class.php';

class Film {
    private $id;
    private $title;
    private $genre;
    private $rating;
    private $duration;
    private $description;
    private $locations;
    private $times;
    private $imageUrl;
    private $created_at;

    public function __construct($data = []) {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $this->sanitizeInput($key, $value);
            }
        }
    }

    private function sanitizeInput($field, $value) {
        switch ($field) {
            case 'title':
            case 'genre':
            case 'duration':
            case 'description':
            case 'locations':
            case 'times':
                return filter_var($value, FILTER_SANITIZE_STRING);
            
            case 'rating':
                return filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            
            case 'imageUrl':
                $cleanUrl = filter_var($value, FILTER_SANITIZE_URL);
                if (strlen($cleanUrl) > 512) {
                    throw new InvalidArgumentException("Afbeelding URL is te lang (max 512 karakters)");
                }
                return $cleanUrl;
            
            default:
                return $value;
        }
    }

    public function save() {
        $pdo = Database::getInstance();

        $requiredFields = ['title', 'genre', 'rating', 'duration', 'imageUrl'];
        foreach ($requiredFields as $field) {
            if (empty($this->$field)) {
                throw new Exception("Verplicht veld ontbreekt: $field");
            }
        }

        $data = [
            'title' => $this->title,
            'genre' => $this->genre,
            'rating' => $this->rating,
            'duration' => $this->duration,
            'description' => $this->description ?? '',
            'locations' => $this->locations,
            'times' => $this->times,
            'imageUrl' => $this->imageUrl
        ];

        if ($this->id) {
            $query = "UPDATE movies SET 
                title = :title,
                genre = :genre,
                rating = :rating,
                duration = :duration,
                description = :description,
                locations = :locations,
                times = :times,
                imageUrl = :imageUrl
                WHERE id = :id";
            $data['id'] = $this->id;
        } else {
            $query = "INSERT INTO movies 
                (title, genre, rating, duration, description, locations, times, imageUrl)
                VALUES (:title, :genre, :rating, :duration, :description, :locations, :times, :imageUrl)";
        }

        $stmt = $pdo->prepare($query);
        $stmt->execute($data);

        if (!$this->id) {
            $this->id = $pdo->lastInsertId();
        }
        return true;
    }

    public function delete() {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("DELETE FROM movies WHERE id = ?");
        return $stmt->execute([$this->id]);
    }

    public static function getAll() {
        $pdo = Database::getInstance();
        $stmt = $pdo->query("SELECT * FROM movies ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function findById($id) {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM movies WHERE id = ?");
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Getters met XSS preventie
    public function getId() { return $this->id; }
    public function getTitle() { return htmlspecialchars($this->title); }
    public function getGenre() { return htmlspecialchars($this->genre); }
    public function getRating() { return htmlspecialchars($this->rating); }
    public function getDuration() { return htmlspecialchars($this->duration); }
    public function getDescription() { return htmlspecialchars($this->description); }
    public function getLocations() { return htmlspecialchars($this->locations); }
    public function getTimes() { return htmlspecialchars($this->times); }
    public function getImageUrl() { return htmlspecialchars($this->imageUrl); }
    public function getCreatedAt() { return $this->created_at; }
}
?>