function addToCart(id, count, sizeId) {
    $.ajax({
        type: 'POST',
        url: '/first-serious-project/addToCart',
        data: {
            cocktail_id: id,
            count: count,
            size_id: sizeId,
        },
        success: function (response) {
            if (response === 'ne success') {
                alert('Error');
            } else {
                alert("Added");
            }
        }
    });
}
