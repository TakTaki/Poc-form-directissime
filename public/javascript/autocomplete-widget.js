window.onload = () => {
      document.querySelector('.autocomplete-widget').addEventListener('input', function (e) {
        var div = e.target.closest(".autocomplete-widget")

       var url = div.getAttribute('data-autocomplete-url');
       var searchValue = e.target.value;

       fetch(url + '?q=' + searchValue)
         .then(function (response) {
           return response.json();
         }).then(
           function (body) {
             console.log(body);
           }
       );
    });

  document.querySelector('.add-another-collection-widget').addEventListener('click', function (e) {
    console.log('test');
    var listId = e.target.getAttribute('data-list-selector');

    var list = document.querySelector(listId);
    // Try to find the counter of the list or use the length of the list
    var counter = list.getAttribute('data-widget-counter') || list.children().length;

    // grab the prototype template
    var newWidget = list.getAttribute('data-prototype');
    // replace the "__name__" used in the id and name of the prototype
    // with a number that's unique to your emails
    // end name attribute looks like name="contact[emails][2]"
    newWidget = newWidget.replace(/__name__/g, counter);
    // Increase the counter
    counter++;
    // And store it, the length cannot be used if deleting widgets is allowed
    list.setAttribute('data-widget-counter', counter);

    // create a new list element and add it to the list
    // var newElem = jQuery(list.attr('data-widget-tags')).html(newWidget);
    var newElem = document.createElement("div");
    newElem.innerHTML = newWidget;
    newElem.setAttribute('data-widget-tags', list.getAttribute('data-widget-tags'));
    list.append(newElem);
  });

}
