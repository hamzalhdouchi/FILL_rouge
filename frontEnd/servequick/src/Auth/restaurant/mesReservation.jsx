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
    const handleModify = (reservation) => {
        setSelectedReservation(reservation);
        setModalOpen(true);
    };
    const handleReservationSubmit = (modifiedReservation) => {
        if (modifiedReservation.date < new Date()) {
            SweetAlert.fire('Erreur!', 'La date de la réservation doit être dans le futur.', 'error');
            return;
        }
    
        axios.put(`/api/reservations/${modifiedReservation.id}`, modifiedReservation)
            .then(() => {
                setModalOpen(false);
                fetchReservations();
                SweetAlert.fire('Modifiée!', 'Votre réservation a été modifiée.', 'success');
            })
            .catch(error => {
                SweetAlert.fire('Erreur!', 'Impossible de modifier la réservation.', 'error');
            });
    };
    const [selectedDishes, setSelectedDishes] = useState([]);

const handleDishSelect = (dish) => {
    setSelectedDishes([...selectedDishes, dish]);
};

const removeDishFromSelection = (dishId) => {
    setSelectedDishes(selectedDishes.filter(dish => dish.id !== dishId));
};


const handleReview = (reservationId, review) => {
    SweetAlert.fire({
        title: 'Laissez un avis',
        input: 'textarea',
        inputPlaceholder: 'Votre avis...',
        showCancelButton: true,
    }).then(result => {
        if (result.isConfirmed) {
            axios.post(`/api/reviews`, { reservationId, review: result.value })
                .then(() => {
                    SweetAlert.fire('Merci!', 'Votre avis a été ajouté.', 'success');
                })
                .catch(error => {
                    SweetAlert.fire('Erreur!', 'Impossible d\'ajouter l\'avis.', 'error');
                });
        }
    });
};
const handleTabChange = (tab) => {
    setActiveTab(tab);
};

return (
    <div>
        <div>
            <button onClick={() => handleTabChange('upcoming')}>À venir</button>
            <button onClick={() => handleTabChange('past')}>Passées</button>
            <button onClick={() => handleTabChange('cancelled')}>Annulées</button>
        </div>
    </div>
const filteredReservations = reservations.filter(reservation => {
    if (activeTab === 'upcoming') return reservation.date >= new Date();
    if (activeTab === 'past') return reservation.date < new Date();
    if (activeTab === 'cancelled') return reservation.status === 'cancelled';
    return true;
});

return (
    <div>
        <div>
            {filteredReservations.map(reservation => (
                <div key={reservation.id}>
                    {/* Affichage des informations de la réservation */}
                </div>
            ))}
        </div>
    </div>
);const Modal = ({ isOpen, onClose, onSubmit, reservation }) => {
    if (!isOpen) return null;

    return (
        <div>
            <div>
                {/* Formulaire de modification */}
                <button onClick={() => onSubmit(reservation)}>Modifier</button>
            </div>
        </div>
    );
};
return (
    <div>
        <div>
            <button onClick={() => handleTabChange('upcoming')}>À venir</button>
            <button onClick={() => handleTabChange('past')}>Passées</button>
            <button onClick={() => handleTabChange('cancelled')}>Annulées</button>
        </div>
        <div>
            {filteredReservations.map(reservation => (
                <div key={reservation.id}>
                    <button onClick={() => handleModify(reservation)}>Modifier</button>
                    <button onClick={() => handleCancel(reservation.id)}>Annuler</button>
                </div>
            ))}
        </div>
    </div>
);


);

    return (
        <div>
           
        </div>
    );
};
