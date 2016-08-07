$(document).ready(function() {

  var ingredients = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
      url: Routing.generate('autocomplete_ingredient_recette', {'caracteres': 'caracteres'}),
      wildcard: 'caracteres'
    }
  });

  function getTypeAheadReady() {
    $('.ingredient_search').typeahead(null, {
      name: 'ingredients',
      display: 'value',
      source: ingredients
    });
  }

  $(document).on('click', '.collection-add', function() {
    $('.ingredient_search').typeahead('destroy');
    getTypeAheadReady();
  })

  getTypeAheadReady();







  $("#ajouter-produit").click(function() { 
    $.ajax({
      type: "POST",
      url: Routing.generate('formulaire_recherche_produit'),
      dataType: 'html',
      cache: false,
      success: function(codeHTML, statut) {
        $("#ajouter-produit").before($(codeHTML).fadeIn());
        $('#entree_liste_rayonProduit').typeahead('destroy');
        getTypeAheadEntreeListeReady();
      }
    });
    return false;
  });

  function getTypeAheadEntreeListeReady() {
    $('#entree_liste_rayonProduit').typeahead(null, {
      name: 'entreeListe',
      display: 'value',
      limit: 20,
      source: entreeListe,
      templates: {
        empty: [
            '<div class="empty-message">',
            'No results',
            '</div>'
        ].join('\n')
      }
    });
  }

  var entreeListe = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
      url: Routing.generate('rechercher_entree_liste', {'caracteres': 'caracteres'}),
      wildcard: 'caracteres'
    }
  });













  $("#rechercher-recette").keyup(function() {
    searchText = $(this).val();
    var urlChercherRecette = Routing.generate('chercher_recette', {'slugUser': 'paul-mesnilgrente','caracteres': searchText});
    if (searchText.length >= 3) {
      $.ajax({
        type: "POST",
        url: urlChercherRecette,
        dataType: 'html',
        cache: false,
        success: function(codeHTML, statut) {
          $("#results").html(codeHTML);
        }
      });
    } else {
      $("#results").html("");
    }
    return false;
  });

  var strPrecedente = $("#semaine-precedente").attr("title").split("-");
  var strSuivante = $("#semaine-suivante").attr("title").split("-");

  var datePrecedente = new Date(strPrecedente[2], strPrecedente[1], strPrecedente[0]);
  var dateSuivante = new Date(strSuivante[2], strSuivante[1], strSuivante[0]);

  $("#semaine-precedente").click(function() {
    dateSuivante = datePrecedente;
    datePrecedente.setDate(datePrecedente.getDate() - 7);
    var urlSemaine = Routing.generate('tableau_body_planning', {'date':  dateSuivante.getDate() + '-' + dateSuivante.getMonth() + '-' + dateSuivante.getFullYear()});
    $.ajax({
      type: "POST",
      url: urlSemaine,
      dataType: 'html',
      cache: false,
      success: function(codeHTML) {
        $("#planning tbody").fadeOut("slow", function() {
          $("#planning tbody").replaceWith($(codeHTML).fadeIn());
        });
      }
    });
    return false;
  });

  $("#semaine-suivante").click(function() {
    datePrecedente = dateSuivante;
    dateSuivante.setDate(dateSuivante.getDate() + 7);

    var urlSemaine = Routing.generate('tableau_body_planning', {'date': datePrecedente.getDate() + '-' + datePrecedente.getMonth() + '-' + datePrecedente.getFullYear()});
    $.ajax({
      type: "POST",
      url: urlSemaine,
      dataType: 'html',
      cache: false,
      success: function(codeHTML) {
        $("#planning tbody").fadeOut("slow", function() {
          $("#planning tbody").replaceWith($(codeHTML).fadeIn());
        });
      }
    });
    return false;
  });
  return false;
});
