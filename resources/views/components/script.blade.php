<script>
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    document.querySelectorAll(".delete").forEach(item => {
        item.addEventListener("click", event => {
            event.preventDefault();
            fetch(event.target.href, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': token
                },
                method: 'DELETE',

            });
        })
    });
</script>
