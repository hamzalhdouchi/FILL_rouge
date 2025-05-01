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
