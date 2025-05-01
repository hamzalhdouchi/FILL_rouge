import React, { useState, useEffect } from 'react';
import axios from 'axios';
import SweetAlert from 'sweetalert2';
import { useHistory } from 'react-router-dom';

const ReservationsPage = () => {
    const [user, setUser] = useState(null);
    const [reservations, setReservations] = useState([]);
    const [activeTab, setActiveTab] = useState('upcoming');
    const history = useHistory();
    
    useEffect(() => {
        const storedUser = sessionStorage.getItem('user');
        if (storedUser) {
            setUser(JSON.parse(storedUser));
        }
    }, []);
    
    return (
        <div>
           
        </div>
    );
};
