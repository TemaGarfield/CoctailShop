$.ajax({
    type: "GET",
    url: "/first-serious-project/getAll",
    dataType: "json",
    success: function (response) {
        createPage(response);
    }
});

function createPage(data) {

    const body = document.getElementById('container');

    data['coctails'].forEach(element => {
        const h1 = document.createElement('h1');
        const img = document.createElement('img');
        const p = document.createElement('p');
        const select = document.createElement('select');
        const input = document.createElement('input');

        h1.textContent = element['name'];
        img.src = element['image_url'];
        img.width = 200;
        img.height = 300;
        p.textContent = 'Price: ' + element['price'] + ' BYN';
        p.className = 'test';
        const option = document.createElement('option');
        option.text = '--';
        select.appendChild(option);
        data['sizes'].forEach(size => {
            const option = document.createElement('option');
            option.text = size['capacity'];
            option.value = size['id'];
            select.appendChild(option);
        });
        input.type = 'number';
        input.min = 0;
        input.defaultValue = 0;
        input.id = 'count';
        input.onchange = function () {
            addToCart(element['id'], input.value, select.value);
        };

        body.appendChild(h1);
        body.appendChild(img);
        body.appendChild(p);
        body.appendChild(select);
        body.appendChild(input);
    });
}
