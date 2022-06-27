const search = document.querySelector('input[placeholder="search set"]');
const setContainer = document.querySelector(".section-container");
const deleteButton = document.querySelectorAll("#delete-button");
const card = document.querySelectorAll(".flashcard");

search.addEventListener("keyup", async function (event) {
    event.preventDefault();
    await new Promise(r => setTimeout(r, 500));

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
        setContainer.innerHTML = "";
        loadSets(sets)
    });
});

function delay(fn, ms) {
    let timer = 0
    return function(...args) {
        clearTimeout(timer)
        timer = setTimeout(fn.bind(this, ...args), ms || 0)
    }
}

function loadSets(sets) {
    sets.forEach(set => {
        console.log(set);
        createSet(set);
    });
}

function createSet(set) {
    const template = document.querySelector("#set-template");

    const clone = template.content.cloneNode(true);

    const div = clone.querySelector(".flashcard");
    div.id = set.id;
    div.addEventListener("click", showCards);
    const name = clone.querySelector(".flashcard-category");
    name.innerHTML = set.name;
    const terms = clone.querySelector(".category-terms");
    terms.innerHTML = "x terms";
    const bt = clone.querySelector("#delete-button");
    bt.addEventListener("click", deleteSet);
    setContainer.appendChild(clone);
}

function deleteSet(e) {
    e.preventDefault();
    e.stopPropagation();
    const id = this.parentElement.getAttribute("id");
    window.location = '/deleteSet?id=' + id;
}

function showCards() {
    const id = this.getAttribute("id");
    window.location = '/card?id=' + id;
}

deleteButton.forEach(button => button.addEventListener("click", deleteSet));
card.forEach(button => button.addEventListener("click", showCards));
