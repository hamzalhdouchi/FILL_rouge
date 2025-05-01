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

  useEffect(() => {
    axios.get(`http://localhost:8000/api/categories/${menu_id}`).then(res => setCategories(res.data));
    axios.get(`http://localhost:8000/api/ingredients/${res_id}/res`).then(res => setIngredients(res.data));
  }, []);
  const handleChange = (e) => {
    const { name, value, type, files } = e.target;

    if (name === 'image') {
      setForm(prev => ({ ...prev, image: files[0] }));
    } else if (name === 'ingredients') {
      const selected = Array.from(e.target.selectedOptions, opt => opt.value);
      setForm(prev => ({ ...prev, ingredients: selected }));
    } else {
      setForm(prev => ({ ...prev, [name]: value }));
    }
  };
  const handleSubmit = async (e) => {
    e.preventDefault();

    const formData = new FormData();
    Object.entries(form).forEach(([key, value]) => {
      if (key === 'ingredients') {
        value.forEach(id => formData.append('ingredients[]', id));
      } else {
        formData.append(key, value);
      }
    });

    setIsLoading(true);

