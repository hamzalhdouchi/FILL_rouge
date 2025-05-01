import React, { useState, useCallback, useEffect } from 'react';
import axios from 'axios';
import Swal from 'sweetalert2';
import PropTypes from 'prop-types';

const UNITS = [
  { value: 'g', label: 'Grammes (g)' },
  { value: 'kg', label: 'Kilogrammes (kg)' },
  { value: 'ml', label: 'Millilitres (ml)' },
  { value: 'L', label: 'Litres (L)' },
  { value: 'unité', label: 'Unité' },
];

const AddIngredientsModal = ({ closeModal, fetchdata }) => {
  const restaurants = JSON.parse(sessionStorage.getItem('restaurant'));
  const res_id = restaurants.id;

  const [formState, setFormState] = useState({
    ingredients: [{ nom_ingredient: '', stock: '', unite_mesure: '', restaurants_id: res_id }],
    isLoading: false,
    error: null,
    touched: {}
  });

  const handleChange = useCallback((index, e) => {
    const { name, value } = e.target;
    setFormState(prev => {
      const updatedIngredients = [...prev.ingredients];
      updatedIngredients[index] = { ...updatedIngredients[index], [name]: value };
      
      return {
        ...prev,
        ingredients: updatedIngredients,
        touched: { ...prev.touched, [`${name}-${index}`]: true }
      };
    });
  }, []);
  
  const addIngredientField = useCallback(() => {
    setFormState(prev => ({
      ...prev,
      ingredients: [...prev.ingredients, { nom_ingredient: '', stock: '', unite_mesure: '', restaurants_id: res_id }]
    }));
  }, []);
  
  const removeIngredientField = useCallback((index) => {
    setFormState(prev => ({
      ...prev,
      ingredients: prev.ingredients.filter((_, i) => i !== index)
    }));
  }, []);
  const validateField = (field, value, index) => {
    if (!value.trim()) return 'Ce champ est requis';
    if (field === 'stock' && isNaN(value)) return 'Doit être un nombre valide';
    if (field === 'stock' && parseFloat(value) < 0) return 'Doit être positif';
    return null;
  };
  const validateForm = useCallback(() => {
    const errors = [];
    const newTouched = {};
  
    formState.ingredients.forEach((ing, index) => {
      ['nom_ingredient', 'stock', 'unite_mesure'].forEach(field => {
        newTouched[`${field}-${index}`] = true;
        const error = validateField(field, ing[field], index);
        if (error) errors.push(`Ingrédient #${index + 1}: ${error}`);
      });
    });
  
    setFormState(prev => ({ ...prev, touched: newTouched }));
    return errors.length === 0 ? true : errors.join('\n');
  }, [formState.ingredients]);
  
  const handleFormSubmit = useCallback(async (e) => {
    e.preventDefault();
    
    const validationResult = validateForm();
    if (validationResult !== true) {
      setFormState(prev => ({ ...prev, error: validationResult }));
      return;
    }
  
    try {
      setFormState(prev => ({ ...prev, isLoading: true, error: null }));
  
      const response = await axios.post('http://localhost:8000/api/ingredients', 
        { ingredients: formState.ingredients },
        { headers: { 'Content-Type': 'application/json' } }
      );
  
      if (response.status === 201) {
        await Swal.fire({
          title: "Succès!",
          text: response.data.message || "Ingrédients ajoutés avec succès",
          icon: "success",
          confirmButtonText: "OK",
        });
  
        closeModal();
        fetchdata();
      }
    } catch (error) {
      console.error('Erreur:', error);
      const errorMessage = error.response?.data?.message || 
      error.response?.data?.errors?.join('\n') || 
      "Erreur lors de l'enregistrement";
  
      await Swal.fire({
        title: "Erreur",
        text: errorMessage,
        icon: "error",
        confirmButtonText: "OK",
      });
    } finally {
      setFormState(prev => ({ ...prev, isLoading: false }));
    }
  }, [formState.ingredients, validateForm, closeModal]);
  

  return (
    
    <div>..
        
        .</div>
  );
};

export default AddIngredientsModal;
