let currentAlbumIndex = 0;
let albums = [];
let isLooping = false;

// Fetch album data from the PHP script
async function fetchAlbums() {
    try {
        const response = await fetch('../php/fetch_albums.php');
        albums = await response.json();
        displayAlbums(albums);
        if (albums.length > 0) {
            updateCommonAudioPlayer(albums[currentAlbumIndex]);
        }
    } catch (error) {
        console.error('Error fetching albums:', error);
    }
}

// Display albums dynamically
function displayAlbums(albums) {
    const container = document.getElementById('album-container');
    container.innerHTML = ''; // Clear existing content

    albums.forEach((album, index) => {
        const albumCard = document.createElement('div');
        albumCard.className = 'album-card';

        albumCard.innerHTML = `
            <img src="${album.album_cover}" alt="${album.album_title}" class="album-cover">
            <div class="album-title">${album.album_title}</div>
            <div class="album-artist">${album.album_artist}</div>
            <div>${album.genre}</div>
            <div>${album.release_date}</div>
            <p>${album.description}</p>
            <button class="like-button" data-id="${album.id}">❤️</button>
        `;

        // Add click event to play audio in the common audio player
        albumCard.addEventListener('click', () => {
            currentAlbumIndex = index;
            updateCommonAudioPlayer(album);
        });

        // Add like button click event
        const likeButton = albumCard.querySelector('.like-button');
        likeButton.addEventListener('click', (e) => {
            e.stopPropagation(); // Prevent album card click event
            likeAlbum(album.id);
            likeButton.classList.toggle('liked');
        });

        container.appendChild(albumCard);
    });
}

// Update the common audio player with the selected album
function updateCommonAudioPlayer(album) {
    const commonAudio = document.getElementById('common-audio');
    commonAudio.src = album.album_audio;
    commonAudio.play();
}

// Like an album
function likeAlbum(albumId) {
    fetch('../php/like_album.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ albumId }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Album liked successfully');
            } else {
                console.error('Failed to like album');
            }
        })
        .catch(error => console.error('Error:', error));
}

// Previous button functionality
document.getElementById('prev-button').addEventListener('click', () => {
    if (currentAlbumIndex > 0) {
        currentAlbumIndex--;
    } else if (isLooping) {
        currentAlbumIndex = albums.length - 1;
    }
    updateCommonAudioPlayer(albums[currentAlbumIndex]);
});

// Next button functionality
document.getElementById('next-button').addEventListener('click', () => {
    if (currentAlbumIndex < albums.length - 1) {
        currentAlbumIndex++;
    } else if (isLooping) {
        currentAlbumIndex = 0;
    }
    updateCommonAudioPlayer(albums[currentAlbumIndex]);
});

// Loop button functionality
document.getElementById('loop-button').addEventListener('click', () => {
    isLooping = !isLooping;
    document.getElementById('loop-button').textContent = isLooping ? 'Loop: On' : 'Loop: Off';
});

// Fetch albums when the page loads
window.onload = fetchAlbums;