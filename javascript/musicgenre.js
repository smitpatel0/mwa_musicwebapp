function fetchMusicByGenre() {
    const genre = document.getElementById('genre').value;
    fetch(`../php/musicgenre.php?genre=${genre}`)
        .then(response => response.json())
        .then(data => {
            const musicContainer = document.getElementById('musicResults');
            musicContainer.innerHTML = ''; // Clear existing content
            data.forEach(song => {
                const musicCard = `
                    <div class="music-card">
                        <img src="${song.cover_image}" alt="${song.title}">
                        <h3>${song.artist}</h3>
                        <p>${song.title}</p>
                        <audio controls>
                            <source src="${song.track_url}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                `;
                musicContainer.insertAdjacentHTML('beforeend', musicCard);
            });
        })
        .catch(error => console.error('Error fetching data:', error));
}