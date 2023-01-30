
    const containsders = document.querySelector('#data-container');
    const divs = Array.from(containsders.children);

    divs.sort((a, b) => {
    const idA = parseInt(a.id, 10);
    const idB = parseInt(b.id, 10);
    return idA - idB;
});

    divs.forEach(div => containsders.appendChild(div));
