const search = document.querySelector('input[placeholder="search user"]');
const userContainer = document.querySelector(".section-container");
const deleteButton = document.querySelectorAll("#delete-button");

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

    const userid = clone.querySelector(".users");
    userid.id = user.id;
    const id = clone.querySelector("#user-id");
    id.innerHTML = "ID: " + user.id;
    const name = clone.querySelector("#user-name");
    name.innerHTML = "NAME: " + user.name;
    const surname = clone.querySelector("#user-surname");
    surname.innerHTML = "SURNAME: " + user.surname;
    const email = clone.querySelector("#user-email");
    email.innerHTML = "EMAIL: " + user.email;
    const bt = clone.querySelector("#delete-button");
    bt.addEventListener("click", deleteUser);
    userContainer.appendChild(clone);
}

function deleteUser(e) {
    e.preventDefault();
    e.stopPropagation();
    const id = this.parentElement.getAttribute("id");
    window.location = '/deleteUser?id=' + id;
}

deleteButton.forEach(button => button.addEventListener("click", deleteUser));