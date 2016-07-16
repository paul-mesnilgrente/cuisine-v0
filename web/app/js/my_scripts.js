
$(document).ready(function() {
  $("#ajouter-produit").click(function() { 
    var urlFormulaire = Routing.generate('formulaire_recherche_produit', {'slugUser': slugUser});
    $.ajax({
      type: "POST",
      url: urlFormulaire,
      dataType: 'html',
      cache: false,
      success: function(codeHTML, statut) {
        $("#ajouter-produit").before($(codeHTML).fadeIn());
        $("form").index();
      }
    });
    return false;
  });

  $(document).on('keyup', '#produit_search_produit', function() {
    searchText = $(this).val();
    var urlChercherProduit = Routing.generate('rechercher_produit', {'slugUser': slugUser, 'caracteres': searchText});
    if (searchText.length >= 3) {
      $("#resultat-recherche-produit").load(urlChercherProduit);
    } else {
      $("#resultat-recherche-produit").html("");
    }
  });

  $(document).on('click', '.resultat-produit', function() {
    nom = $(this).text();
    $("#produit_search_produit").val(nom);
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
      return false;
    } else {
      $("#results").html("");
    }
  });

  var strPrecedente = $("#semaine-precedente").attr("title").split("-");
  var strSuivante = $("#semaine-suivante").attr("title").split("-");

  var datePrecedente = new Date(strPrecedente[2], strPrecedente[1], strPrecedente[0]);
  var dateSuivante = new Date(strSuivante[2], strSuivante[1], strSuivante[0]);

  $("#semaine-precedente").click(function() {
    dateSuivante = datePrecedente;
    datePrecedente.setDate(datePrecedente.getDate() - 7);
    var urlSemaine = Routing.generate('tableau_body_planning', {'slugUser': slug, 'date': datePrecedente});
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

    var urlSemaine = Routing.generate('tableau_body_planning', {'slugUser': slug, 'date': dateSuivante});
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
});
