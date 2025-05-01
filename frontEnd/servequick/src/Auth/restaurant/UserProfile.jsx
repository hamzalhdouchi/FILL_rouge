import React, { useState, useEffect } from 'react';
import axios from 'axios';

const UserProfile = ({ id_user }) => {
  const [user, setUser] = useState({
    username: '',
    first_name: '',
    email: '',
    phone: '',
    last_password: '',
    new_password: '',
  });
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetchUserProfile();
  }, [id_user]);

  const fetchUserProfile = async () => {
    try {
      const response = await axios.get(`http://127.0.0.1:8000/api/profile/${id_user}`);
      setUser({
        username: response.data.user.nom_utilisateur || '',
        first_name: response.data.user.prenom || '',
        email: response.data.user.email || '',
        phone: response.data.user.telephone || '',
        last_password: '',
        new_password: '',
      });
      setLoading(false);
    } catch (error) {
      console.error('Error fetching user profile:', error);
      setLoading(false);
    }
  };

  if (loading) {
    return <div className="flex justify-center items-center h-40">Chargement...</div>;
  }

  return <div className="p-6">Profil utilisateur</div>;
};

export default UserProfile;
