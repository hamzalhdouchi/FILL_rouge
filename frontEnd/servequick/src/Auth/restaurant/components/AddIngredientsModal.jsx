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
  

  return (
    
    <div>..
        
        .</div>
  );
};

export default AddIngredientsModal;
