let currentPlaylist = []; // Stores the current playlist's songs
let currentSongIndex = 0; // Tracks the currently playing song index
const audioPlayer = document.getElementById('audioPlayer'); // Use the <audio> element from HTML

// Fetch all playlists
async function fetchPlaylists() {
    try {
        const response = await fetch('../php/fetch_playlists.php');
        const playlists = await response.json();
        const playlistContainer = document.getElementById('playlistContainer');
        playlistContainer.innerHTML = playlists.map(playlist => `
            <div class="playlist-card" data-id="${playlist.id}">
                <h3>${playlist.name}</h3>
                <p>${playlist.description}</p>
            </div>
        `).join('');
    } catch (error) {
        console.error('Error fetching playlists:', error);
    }
}

// Fetch songs for a playlist
async function fetchSongs(playlistId) {
    try {
        const response = await fetch(`../php/fetch_songs.php?playlist_id=${playlistId}`);
        const songs = await response.json();
        currentPlaylist = songs; // Update the current playlist
        const songContainer = document.getElementById('songContainer');
        songContainer.innerHTML = songs.map(song => `
            <div class="song-card" data-id="${song.id}">
                <img src="${song.album_cover}" alt="${song.song_name}">
                <div>
                    <h4>${song.song_name}</h4>
                    <p>${song.artist_name}</p>
                </div>
            </div>
        `).join('');
    } catch (error) {
        console.error('Error fetching songs:', error);
    }
}

// Play a song
function playSong(index) {
    if (currentPlaylist.length === 0) return; // No songs in the playlist
    const song = currentPlaylist[index];
    audioPlayer.src = song.song_file; // Set the audio source
    audioPlayer.play(); // Start playback
    document.getElementById('playPauseBtn').textContent = 'Pause'; // Update button text
}

// Event listeners
document.getElementById('playlistContainer').addEventListener('click', (e) => {
    const playlistCard = e.target.closest('.playlist-card');
    if (playlistCard) {
        const playlistId = playlistCard.getAttribute('data-id');
        fetchSongs(playlistId); // Load songs for the selected playlist
    }
});

document.getElementById('songContainer').addEventListener('click', (e) => {
    const songCard = e.target.closest('.song-card');
    if (songCard) {
        const songId = songCard.getAttribute('data-id');
        const index = currentPlaylist.findIndex(song => song.id == songId); // Find the song index
        currentSongIndex = index; // Update the current song index
        playSong(index); // Play the selected song
    }
});

// Play/Pause button
document.getElementById('playPauseBtn').addEventListener('click', () => {
    if (audioPlayer.paused) {
        audioPlayer.play();
        document.getElementById('playPauseBtn').textContent = 'Pause';
    } else {
        audioPlayer.pause();
        document.getElementById('playPauseBtn').textContent = 'Play';
    }
});

// Previous button
document.getElementById('prevBtn').addEventListener('click', () => {
    if (currentSongIndex > 0) {
        currentSongIndex--; // Move to the previous song
        playSong(currentSongIndex);
    }
});

// Next button
document.getElementById('nextBtn').addEventListener('click', () => {
    if (currentSongIndex < currentPlaylist.length - 1) {
        currentSongIndex++; // Move to the next song
        playSong(currentSongIndex);
    }
});

// Initialize: Fetch playlists when the page loads
fetchPlaylists();