document.addEventListener('DOMContentLoaded', function(){
    const appUrl = '/js_lesson5/app.php';
    var url = new URL(window.location.href);
    var search = url.searchParams.get("s");

    let searchForm = document.getElementById('filter-form');
    let searchInput = searchForm.querySelector('[name="s"]');
    let resetButton = document.getElementById('reset');
    let addPostForm = document.getElementById('add-post-form');

    if(!search) {
        showPosts(appUrl);
    } else {
        showPosts(appUrl + '?s=' + search);
    }

    searchForm.addEventListener('submit', () => {
       showPosts(appUrl + '?s=' + search);
    });

    resetButton.addEventListener('click', () => { showPosts(appUrl);  searchInput.value = ''});

    addPostForm.addEventListener('submit', function(e) {
        e.preventDefault();
        let data = new FormData(this);
        addPost(appUrl, data);
        this.querySelectorAll('[type="text"]').forEach(item => {item.value = ''});
    });

    async function getData(url) {
       let response = await fetch(url);
       if(!response.ok){
           throw new Error(response.statusText);
       } else {
           return response.json();
       }
    }

    async function sendData(url, data) {
        let response = await fetch(url, {method: 'POST', body: data});
        if(!response.ok){
            throw new Error(response.statusText);
        }
    }

    function addPost(url, data) {
        sendData(url, data)
            .then(() => showPosts(appUrl))
            .catch(reason => console.log(reason))
    }

    function showPosts(url) {
       getData(url).then((data) => {
           let tbody = document.querySelector('#catalogue tbody');
           tbody.innerHTML = '';

           if(!data.length){
               let notFoundMsg = 'Статьи не найдены';
               tbody.innerHTML = notFoundMsg;
               throw new Error(notFoundMsg);
           }

           data.forEach(row => {
               let tr = document.createElement('tr');
               for(col in row) {
                   let td = document.createElement('td');
                   td.innerHTML = row[col];
                   tr.appendChild(td);
               }
               tbody.appendChild(tr);
           });
       }).catch(reason => console.log(reason));
    }
});