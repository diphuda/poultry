function deleteData(e){Swal.fire({title:"Are you sure?",text:"You won't be able to revert this!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, delete it!"}).then((t=>{t.isConfirmed&&document.getElementById("delete-form-"+e).submit()}))}function approveData(e){Swal.fire({title:"Are you sure?",text:"You won't be able to revert this!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, Approve it!"}).then((t=>{t.isConfirmed&&document.getElementById("approve-"+e).submit()}))}function makeFeed(){Swal.fire({title:"Are you sure?",text:"You won't be able to edit this!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, Make Feed!",cancelButtonText:"Check Again"}).then((e=>{e.isConfirmed&&document.getElementById("make-feed").submit()}))}
