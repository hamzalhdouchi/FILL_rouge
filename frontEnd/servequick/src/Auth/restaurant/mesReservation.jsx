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
    const fetchReservations = () => {
        axios.get(`/api/reservations?userId=${user.id}`)
            .then(response => {
                setReservations(response.data);
            })
            .catch(error => {
                console.error('Erreur de récupération des réservations:', error);
            });
    };
    
    useEffect(() => {
        if (user) {
            fetchReservations();
        }
    }, [user, activeTab]);
    const handleCancel = (reservationId) => {
        SweetAlert.fire({
            title: 'Êtes-vous sûr ?',
            text: 'Cette réservation sera annulée.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui, annuler',
            cancelButtonText: 'Non, garder',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/api/reservations/${reservationId}`)
                    .then(() => {
                        fetchReservations();
                        SweetAlert.fire('Annulée!', 'Votre réservation a été annulée.', 'success');
                    })
                    .catch(error => {
                        SweetAlert.fire('Erreur!', 'Impossible d\'annuler la réservation.', 'error');
                    });
            }
        });
    };
    
    return (
        <div>
           
        </div>
    );
};
