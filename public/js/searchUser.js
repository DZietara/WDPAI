const search = document.querySelector('input[placeholder="search user"]');
const userContainer = document.querySelector(".section-container");

search.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();

        const data = {search: this.value};

        fetch("/searchUser", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (users) {
            userContainer.innerHTML = "";
            loadUsers(users)
        });
    }
});

function loadUsers(users) {
    users.forEach(user => {
        console.log(user);
        createUser(user);
    });
}

function createUser(user) {
    const template = document.querySelector("#user-template");

    const clone = template.content.cloneNode(true);

    const id = clone.querySelector(".user-id");
    id.innerHTML = user.id;
    const name = clone.querySelector(".user-name");
    name.innerHTML = user.name;
    const surname = clone.querySelector(".user-surname");
    surname.innerHTML = user.surname;
    const email = clone.querySelector(".user-email");
    email.innerHTML = user.email;

    userContainer.appendChild(clone);
}
