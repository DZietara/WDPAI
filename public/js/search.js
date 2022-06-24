const search = document.querySelector('input[placeholder="search set"]');
const projectContainer = document.querySelector(".section-container");

search.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();

        const data = {search: this.value};

        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (sets) {
            projectContainer.innerHTML = "";
            loadProjects(sets)
        });
    }
});

function loadProjects(sets) {
    sets.forEach(set => {
        console.log(set);
        createProject(set);
    });
}

function createProject(set) {
    const template = document.querySelector("#set-template");

    const clone = template.content.cloneNode(true);

    const div = clone.querySelector(".flashcard");
    div.id = set.id;
    const name = clone.querySelector(".flashcard-category");
    name.innerHTML = set.name;
    const terms = clone.querySelector(".category-terms");
    terms .innerHTML = "x terms";

    projectContainer.appendChild(clone);
}
