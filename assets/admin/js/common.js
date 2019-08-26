var deleteItem = $("#delete");

if (deleteItem)
{
  deleteItem.click(function(){
    $(".items").attr("checked", this.checked);
  });
}