// Fetch liked albums from the database
        async function fetchLikedAlbums() {
            try {
                const response = await fetch('../php/fetch_liked_albums.php');
                const likedAlbums = await response.json();
                displayLikedAlbums(likedAlbums);
            } catch (error) {
                console.error('Error fetching liked albums:', error);
            }
        }

        // Display liked albums
        function displayLikedAlbums(likedAlbums) {
            const container = document.getElementById('liked-albums-container');
            container.innerHTML = ''; // Clear existing content

            likedAlbums.forEach(album => {
                const albumCard = document.createElement('div');
                albumCard.className = 'album-card';

                albumCard.innerHTML = `
                    <img src="${album.album_cover}" alt="${album.album_title}" class="album-cover">
                    <div class="album-title">${album.album_title}</div>
                    <div class="album-artist">${album.album_artist}</div>
                    <div>${album.genre}</div>
                    <div>${album.release_date}</div>
                    <p>${album.description}</p>
                `;

                container.appendChild(albumCard);
            });
        }

        // Fetch liked albums when the page loads
        window.onload = fetchLikedAlbums;