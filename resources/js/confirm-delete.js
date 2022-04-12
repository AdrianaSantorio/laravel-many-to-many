
const deleteForms = document.querySelectorAll('.delete-form');
deleteForms.forEach(form => {
    form.addEventListener('submit', (e) => {
    e.preventDefault();
    const confirmation = confirm('Do you want to delete this post?');
    if(confirmation) e.target.submit();
    });
});