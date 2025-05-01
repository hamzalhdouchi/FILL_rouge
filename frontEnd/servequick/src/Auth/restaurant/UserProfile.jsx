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
  
};

export default UserProfile;
