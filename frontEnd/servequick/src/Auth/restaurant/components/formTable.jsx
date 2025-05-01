import React, { useState, useCallback, useEffect } from 'react';
import axios from 'axios';
import Swal from 'sweetalert2';
import PropTypes from 'prop-types';
const TABLE_STATUSES = [
    { value: 'libre', label: 'Libre' },
    { value: 'occupee', label: 'Occupée' },
    { value: 'reservee', label: 'Réservée' },
  ];
  const [formState, setFormState] = useState({
    numeroDeTable: initialData?.numeroDeTable || '',
    capacite: initialData?.capacite || 2,
    statut: initialData?.statut || 'libre',
    isLoading: false,
    error: null,
    touched: {}
  });
  useEffect(() => {
    if (formState.error) {
      setFormState(prev => ({ ...prev, error: null }));
    }
  }, [formState.numeroDeTable, formState.capacite, formState.statut]);
  const handleChange = useCallback((e) => {
    const { name, value } = e.target;
    setFormState(prev => ({
      ...prev,
      [name]: value,
      touched: { ...prev.touched, [name]: true }
    }));
  }, []);
  const validateField = (field, value) => {
    if (!value && field !== 'qrCode') return 'Ce champ est requis';
    if (field === 'numeroDeTable' && !/^\d+$/.test(value)) return 'Doit être un nombre';
    if (field === 'capacite' && (!Number.isInteger(Number(value)) || value < 1) ){
      return 'Doit être un nombre entier positif';
    }
    return null;
  };
  const validateForm = useCallback(() => {
    const errors = [];
    const newTouched = { ...formState.touched };

    ['numeroDeTable', 'capacite', 'statut'].forEach(field => {
      newTouched[field] = true;
      const error = validateField(field, formState[field]);
      if (error) errors.push(`${field === 'numeroDeTable' ? 'Numéro de table' : 
                            field === 'capacite' ? 'Capacité' : 'Statut'}: ${error}`);
    });

    setFormState(prev => ({ ...prev, touched: newTouched }));
    return errors.length === 0 ? true : errors.join('\n');
  }, [formState.numeroDeTable, formState.capacite, formState.statut]);
  const handleSubmit = useCallback(async (e) => {
    e.preventDefault();
    
    const validationResult = validateForm();
    if (validationResult !== true) {
      setFormState(prev => ({ ...prev, error: validationResult }));
      return;
    }

    try {
      setFormState(prev => ({ ...prev, isLoading: true, error: null }));
      
      const restaurant = JSON.parse(sessionStorage.getItem('restaurant'));
      const restaurant_id = restaurant.id;
      const tableData = {
        numeroDeTable: formState.numeroDeTable,
        capacite: Number(formState.capacite),
        statut: formState.statut,
        restaurant_id
      };
      const response = isEditMode 
        ? await axios.put(`http://localhost:8000/api/restaurants/${restaurant_id}/tables`, {
            ...tableData,
            idTable: initialData.id
          })
        : await axios.post(`http://localhost:8000/api/restaurants/${restaurant_id}/tables`, tableData);
        await Swal.fire({
            title: "Succès!",
            text: response.data.message || 
                 (isEditMode ? "Table mise à jour" : "Table créée") + " avec succès",
            icon: "success",
            timer: 2000,
            showConfirmButton: false
          });
    
          fetchTables();
          closeModal();
        } catch (error) {
            console.error('Erreur:', error);
            const errorMessage = error.response?.data?.message || 
                                error.response?.data?.errors?.join('\n') || 
                                `Erreur lors de ${isEditMode ? 'la mise à jour' : 'la création'} de la table`;
      
            setFormState(prev => ({ ...prev, error: errorMessage }));
      
            await Swal.fire({
              title: "Erreur",
              text: errorMessage,
              icon: "error",
            });
          } finally {
            setFormState(prev => ({ ...prev, isLoading: false }));
          }
        }, [formState, restaurantId, isEditMode, initialData, validateForm, closeModal, fetchTables]);
        const hasError = (field) => {
            return formState.touched[field] && validateField(field, formState[field]);
          };
        