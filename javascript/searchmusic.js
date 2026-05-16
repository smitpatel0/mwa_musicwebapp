 // Sample music master table (simulating a database)
        //const musicMasterTable = {
		const song = {
            classical: [
                { title: "Clair de Lune", artist: "Claude Debussy" },
                { title: "Symphony No. 9", artist: "Ludwig van Beethoven" },
                { title: "The Four Seasons", artist: "Antonio Vivaldi" }
            ],
			hiphop: [
                { title: "Lose Yourself", artist: "Eminem" },
                { title: "Sicko Mode", artist: "Travis Scott" },
                { title: "HUMBLE.", artist: "Kendrick Lamar" }
            ],
			romance: [
                { title: "Bohemian Rhapsody", artist: "Queen" },
                { title: "Stairway to Heaven", artist: "Led Zeppelin" },
                { title: "Hotel California", artist: "Eagles" }
            ],
            pop: [
                { title: "Blinding Lights", artist: "The Weeknd" },
                { title: "Shape of You", artist: "Ed Sheeran" },
                { title: "Levitating", artist: "Dua Lipa" }
            ],
            gujarati: [
                { title: "Take Five", artist: "Dave Brubeck" },
                { title: "So What", artist: "Miles Davis" },
                { title: "Feeling Good", artist: "Nina Simone" }
            ],
			english: [
                { title: "Take Five", artist: "Dave Brubeck" },
                { title: "So What", artist: "Miles Davis" },
                { title: "Feeling Good", artist: "Nina Simone" }
            ]
        };

        // Function to search music based on selected genre
        function searchMusic() {
            const genre = document.getElementById("genre-select").value;
            const playlistContainer = document.getElementById("playlist");
            const noResultsMessage = document.getElementById("no-results");

            // Clear previous results
            playlistContainer.innerHTML = "";
            noResultsMessage.style.display = "none";

            if (genre && song[genre]) {
                const songs = song[genre];
                songs.forEach(song => {
                    const li = document.createElement("li");
                    li.innerHTML = `<h3>${song.title}</h3><p>by ${song.artist}</p>`;
                    playlistContainer.appendChild(li);
                });
            } else {
                noResultsMessage.style.display = "block";
            }
        }