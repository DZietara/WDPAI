const card = document.querySelectorAll(".flashcard");

function showCards() {
    const id = this.getAttribute("id");
    window.location = '/card?id=' + id;
}

card.forEach(button => button.addEventListener("click", showCards));
