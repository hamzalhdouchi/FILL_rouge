import React, { useState, useEffect } from 'react';
import axios from 'axios';
import Swal from 'sweetalert2';

export default function CreatePlatModal({ closeModal, selectedPlat, fetchPlats }) {
  const [categories, setCategories] = useState([]);
  const [ingredients, setIngredients] = useState([]);
  const [isLoading, setIsLoading] = useState(false);
  const [error, setError] = useState(null);
  const menu = JSON.parse(sessionStorage.getItem('menu'));
  const menu_id = menu[0].id;

  const restaurants = JSON.parse(sessionStorage.getItem('restaurant'));
  const res_id = restaurants.id;
  const [form, setForm] = useState({
    nom_plat: selectedPlat ? selectedPlat.nom_plat : '',
    desciption: selectedPlat ? selectedPlat.desciption : '',
    prix: selectedPlat ? selectedPlat.prix : '',
    temps_Preparation: selectedPlat ? selectedPlat.temps_Preparation : '',
    image: null,
    categorie_id: selectedPlat ? selectedPlat.categorie_id : '',
    ingredients: selectedPlat ? selectedPlat.ingredients : [],
    menu_id: parseInt(menu_id),
  });
