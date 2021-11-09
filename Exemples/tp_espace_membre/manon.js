const allLinks = document.head.querySelector('#link');

const button = document.querySelector('#toggle_css');

button.addEventListener('click', event => {
    console.log(allLinks.href);
    if (allLinks.href.endsWith("denis.css")) {
        allLinks.href = "./jeremy.css";
    } else if (allLinks.href.endsWith("jeremy.css")) {
        allLinks.href = "./denis.css";
    }
});
