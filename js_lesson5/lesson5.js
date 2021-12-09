document.addEventListener('DOMContentLoaded', function(){
   let searchForm = document.getElementById('filter-form');
   let searchInput = searchForm.querySelector('[name="s"]');
   let resetButton = document.getElementById('reset');

   getData();

   searchForm.addEventListener('submit', () => getData({
       method: 'POST',
       body: new FormData(searchForm)
   }));

   resetButton.addEventListener('click', () => { getData();  searchInput.value = ''});

   function getData(init = {}) {
       fetch('/js_lesson5/app.php', init)
           .then((response) => {
                   if(!response.ok){
                   throw new Error(response.statusText);
               }
               return response.json();
           }).then((data) => {
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