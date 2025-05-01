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
  
  const hasError = (field, index) => {
    const isTouched = formState.touched[`${field}-${index}`];
    const value = formState.ingredients[index][field];
    return isTouched && validateField(field, value, index);
  };
  return (
    <div className="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
      <div className="bg-white rounded-xl shadow-2xl w-full max-w-2xl overflow-hidden animate-fade-in">
        <div className="bg-wood-700 text-white py-4 px-6 sticky top-0 z-10">
          <div className="flex justify-between items-center">
            <h2 className="text-xl font-bold font-serif">Ajouter des Ingrédients</h2>
            <button 
              onClick={closeModal} 
              className="text-white hover:text-wood-200 transition-colors focus:outline-none"
              disabled={formState.isLoading}
              aria-label="Fermer la modal"
            >
              <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  );
  <form onSubmit={handleFormSubmit} className="p-6 space-y-4 overflow-y-auto max-h-[calc(100vh-200px)]">
  {formState.ingredients.map((ingredient, index) => (
    <fieldset key={index} className="grid grid-cols-12 gap-4 items-end border-b border-gray-200 pb-4 mb-4 last:border-0">
      <div className="col-span-4">
        <label htmlFor={`nom_ingredient-${index}`} className="block text-sm font-medium text-gray-700 mb-1">Nom *</label>
        <input
          type="text"
          id={`nom_ingredient-${index}`}
          name="nom_ingredient"
          value={ingredient.nom_ingredient}
          onChange={(e) => handleChange(index, e)}
          disabled={formState.isLoading}
          className={`w-full px-3 py-2 border rounded-lg focus:ring-wood-500 focus:border-wood-500 ${
            hasError('nom_ingredient', index) ? 'border-red-500' : 'border-gray-300'
          } disabled:bg-gray-100`}
          aria-invalid={!!hasError('nom_ingredient', index)}
        />
      </div>
      
      <div className="col-span-3">
        <label htmlFor={`stock-${index}`} className="block text-sm font-medium text-gray-700 mb-1">Stock *</label>
        <input
          type="number"
          id={`stock-${index}`}
          name="stock"
          min="0"
          step="0.01"
          value={ingredient.stock}
          onChange={(e) => handleChange(index, e)}
          disabled={formState.isLoading}
          className={`w-full px-3 py-2 border rounded-lg focus:ring-wood-500 focus:border-wood-500 ${
            hasError('stock', index) ? 'border-red-500' : 'border-gray-300'
          } disabled:bg-gray-100`}
        />
      </div>

      <div className="col-span-3">
        <label htmlFor={`unite_mesure-${index}`} className="block text-sm font-medium text-gray-700 mb-1">Unité *</label>
        <select
          id={`unite_mesure-${index}`}
          name="unite_mesure"
          value={ingredient.unite_mesure}
          onChange={(e) => handleChange(index, e)}
          disabled={formState.isLoading}
          className={`w-full px-3 py-2 border rounded-lg focus:ring-wood-500 focus:border-wood-500 ${
            hasError('unite_mesure', index) ? 'border-red-500' : 'border-gray-300'
          } disabled:bg-gray-100`}
        >
          <option value="">Sélectionner</option>
          {UNITS.map(unit => (
            <option key={unit.value} value={unit.value}>{unit.label}</option>
          ))}
        </select>
      </div>
    </fieldset>
  ))}
</form>


  return (
    
    <div>..
        
        .</div>
  );
};

export default AddIngredientsModal;
