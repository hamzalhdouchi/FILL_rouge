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
