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
