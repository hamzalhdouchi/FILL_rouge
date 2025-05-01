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
  // ... code précédent inchangé

const handleChange = (e) => {
    const { name, value } = e.target;
    setUser(prev => ({
      ...prev,
      [name]: value
    }));
  };
  
  // ... dans le return, remplacer "Profil utilisateur" par :
  
  <form>
    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label className="block text-sm font-medium mb-1">Nom d'utilisateur</label>
        <input type="text" name="username" value={user.username} onChange={handleChange} className="w-full p-2 border rounded" />
      </div>
      <div>
        <label className="block text-sm font-medium mb-1">Prénom</label>
        <input type="text" name="first_name" value={user.first_name} onChange={handleChange} className="w-full p-2 border rounded" />
      </div>
      <div>
        <label className="block text-sm font-medium mb-1">Email</label>
        <input type="email" name="email" value={user.email} onChange={handleChange} className="w-full p-2 border rounded" />
      </div>
      <div>
        <label className="block text-sm font-medium mb-1">Téléphone</label>
        <input type="tel" name="phone" value={user.phone} onChange={handleChange} className="w-full p-2 border rounded" />
      </div>
      <div>
        <label className="block text-sm font-medium mb-1">Last Password</label>
        <input type="password" name="last_password" value={user.last_password} onChange={handleChange} className="w-full p-2 border rounded" />
      </div>
      <div>
        <label className="block text-sm font-medium mb-1">Confirmer le mot de passe</label>
        <input type="password" name="new_password" value={user.new_password} onChange={handleChange} className="w-full p-2 border rounded" />
      </div>
    </div>
  </form>
  import Swal from 'sweetalert2';
  const [errors, setErrors] = useState({});
  const [success, setSuccess] = useState(false);
  
  const handleSubmit = async (e) => {
    e.preventDefault();
    setErrors({});
  
    try {
      const updatedUser = {
        nom_utilisateur: user.username,
        prenom: user.first_name,
        email: user.email,
        telephone: user.phone,
      };
  
      if (user.last_password && user.new_password) {
        updatedUser.last_password = user.last_password;
        updatedUser.new_password = user.new_password;
      }
  
      const response = await axios.put(`http://127.0.0.1:8000/api/User/${id_user}/update-profile`, updatedUser);
  
      Swal.fire({
        icon: 'success',
        title: 'Profil mis à jour avec succès!',
        text: response.data.message,
        showConfirmButton: false,
        timer: 1500,
      });
  
      setTimeout(() => {
        window.location.reload();
      }, 1200);
    } catch (error) {
      if (error.response) {
        Swal.fire({
          icon: 'error',
          title: 'Erreur',
          text: error.response.data.message || 'Une erreur est survenue.',
        });
        if (error.response.data.errors) {
          setErrors(error.response.data.errors);
        } else {
          setErrors({ general: ['Erreur inconnue.'] });
        }
      }
    }
  };
  
  // ... dans le formulaire
  <form onSubmit={handleSubmit}>
    {/* les inputs précédents */}
    <div className="mt-6">
      <button type="submit" className="bg-wood-500 hover:bg-wood-600 text-white font-bold py-2 px-6 rounded">
        Enregistrer
      </button>
    </div>
  </form>
  
};

export default UserProfile;
