let currentPlaylist = [];
let currentSongIndex = 0;
const audioPlayer = document.getElementById('audioPlayer');

// Fetch albums
async function fetchAlbums() {
    try {
        const response = await fetch('fetch_albums.php');
        if (!response.ok) throw new Error('Failed to fetch albums');
        const data = await response.json();
        const albumsContainer = document.getElementById('albumsContainer');
        albumsContainer.innerHTML = data.albums.map(album => `
            <div class="album-card" data-id="${album.id}">
                <img src="${album.cover_image}" alt="${album.name}">
                <h3>${album.name}</h3>
                <p>${album.description}</p>
                <button class="like-btn" data-id="${album.id}">Like</button>
            </div>
        `).join('');

        // Add event listeners to album cards
        document.querySelectorAll('.album-card').forEach(card => {
            card.addEventListener('click', () => fetchSongs(card.getAttribute('data-id')));
        });

        // Add event listeners to like buttons
        document.querySelectorAll('.like-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                e.stopPropagation(); // Prevent album card click event
                handleLike(button.getAttribute('data-id'));
            });
        });
    } catch (error) {
        console.error('Error fetching albums:', error);
    }
}

// Fetch songs for an album
async function fetchSongs(albumId) {
    try {
        const response = await fetch(`fetch_songs.php?album_id=${albumId}`);
        if (!response.ok) throw new Error('Failed to fetch songs');
        const data = await response.json();
        currentPlaylist = data.songs;
        const songsContainer = document.getElementById('songsContainer');
        songsContainer.innerHTML = data.songs.map(song => `
            <div class="song-card" data-id="${song.id}">
                <img src="${song.album_cover}" alt="${song.song_name}">
                <div>
                    <h4>${song.song_name}</h4>
                    <p>${song.artist_name}</p>
                </div>
            </div>
        `).join('');

        // Add event listeners to song cards
        document.querySelectorAll('.song-card').forEach(card => {
            card.addEventListener('click', () => {
                const songId = card.getAttribute('data-id');
                const index = currentPlaylist.findIndex(song => song.id == songId);
                currentSongIndex = index;
                playSong(index);
            });
        });
    } catch (error) {
        console.error('Error fetching songs:', error);
    }
}

// Play a song
function playSong(index) {
    if (currentPlaylist.length === 0) return;
    const song = currentPlaylist[index];
    audioPlayer.src = song.song_file;
    audioPlayer.play();
    document.getElementById('playPauseBtn').textContent = 'Pause';
}

// Handle like/unlike
async function handleLike(albumId) {
    try {
        const response = await fetch('handle_like.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ album_id: albumId }),
        });
        if (!response.ok) throw new Error('Failed to handle like');
        const data = await response.json();
        if (data.success) {
            const likeButton = document.querySelector(`.like-btn[data-id="${albumId}"]`);
            likeButton.textContent = data.liked ? 'Unlike' : 'Like';
        }
    } catch (error) {
        console.error('Error handling like:', error);
    }
}

// Event listeners for control buttons
document.getElementById('playPauseBtn').addEventListener('click', () => {
    if (audioPlayer.paused) {
        audioPlayer.play();
        document.getElementById('playPauseBtn').textContent = 'Pause';
    } else {
        audioPlayer.pause();
        document.getElementById('playPauseBtn').textContent = 'Play';
    }
});

document.getElementById('prevBtn').addEventListener('click', () => {
    if (currentSongIndex > 0) {
        currentSongIndex--;
        playSong(currentSongIndex);
    }
});

document.getElementById('nextBtn').addEventListener('click', () => {
    if (currentSongIndex < currentPlaylist.length - 1) {
        currentSongIndex++;
        playSong(currentSongIndex);
    }
});

// Initialize
fetchAlbums();