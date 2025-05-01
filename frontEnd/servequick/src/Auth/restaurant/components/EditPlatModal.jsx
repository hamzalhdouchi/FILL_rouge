import React, { useEffect, useState } from 'react';
import axios from 'axios';
import Swal from 'sweetalert2';

const EditPlatModal = ({ open, onClose, plat, onUpdate, idPlate, ingredients }) => {
  const [formData, setFormData] = useState({
    nom_plat: '',
    desciption: '',
    prix: '',
    image: null,
    temps_Preparation: '',
    categorie_id: '',
    ingredients: [],
  });

  const [isLoading, setIsLoading] = useState(false);
  const [error, setError] = useState(null);
  useEffect(() => {
    if (plat) {
      setFormData({
        nom_plat: plat.nom_plat || '',
        desciption: plat.desciption || '',
        prix: plat.prix || '',
        image: null,
        temps_Preparation: plat.temps_Preparation || '',
        categorie_id: plat.categorie_id || '',
        ingredients: plat.ingredients || [],
      });
    }
  }, [plat]);
  const handleChange = (e) => {
    const { name, value, files } = e.target;
    if (name === 'image') {
      setFormData({ ...formData, image: files[0] });
    } else {
      setFormData({ ...formData, [name]: value });
    }
  };

  const validateForm = () => {
    if (!formData.nom_plat || !formData.prix || !formData.temps_Preparation || !formData.categorie_id) {
      setError('Tous les champs obligatoires doivent être remplis.');
      return false;
    }
    setError(null);
    return true;
  };
  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!validateForm()) return;

    setIsLoading(true);
    try {
      const data = new FormData();
      data.append('nom_plat_plat', formData.nom_plat);
      data.append('desciption', formData.desciption);
      data.append('prix', formData.prix);
      data.append('temps_Preparation', formData.temps_Preparation);
      if (formData.image) {
        data.append('image', formData.image);
      }

      await axios.post(`http://localhost:8000/api/plats/${plat.id}`, data, {
        headers: { 'Content-Type': 'multipart/form-data' },
      });

      Swal.fire({
        icon: 'success',
        title: 'Plat modifié avec succès',
        showConfirmButton: false,
        timer: 2000,
      });

      onUpdate();
      onClose();
      setTimeout(() => {
        window.location.reload();
      }, 3000);
    } catch (error) {
      console.error('Erreur lors de la modification du plat:', error);
      Swal.fire({
        icon: 'error',
        title: 'Erreur',
        text: 'Une erreur est survenue lors de la modification du plat.',
      });
    } finally {
      setIsLoading(false);
    }
  };
