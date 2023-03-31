const deleteButton = document.getElementById('delete-user');
const username = document.getElementById('username');

function createLink(name) {
    var link = document.createElement("a");
    link.href = "#";
    link.className = "nav-link";
    var icon = document.createElement("i");
    icon.className = "fas fa-user";
    var paragraph = document.createElement("p");
    paragraph.id = "username";
    paragraph.textContent = name;
    // var btn = document.createElement("button");
    // btn.id = "delete-user";
    link.appendChild(icon);
    link.appendChild(paragraph);
    // link.appendChild(btn);
    return link;
}
function addLink() {
        var name = prompt("Введите имя:");
        var link = createLink(name);
        var container = document.getElementById("links-container");
        container.appendChild(link);
    }

    deleteButton.addEventListener('click', () => {
    const nameToDelete = prompt("Введите имя для удаления:");
    const links = document.querySelectorAll('.nav-link');
    links.forEach(link => {
        const username = link.querySelector('#username');
        if (username && username.textContent === nameToDelete) {
            link.remove();
        }
    });
});