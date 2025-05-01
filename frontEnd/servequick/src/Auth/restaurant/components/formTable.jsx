import React, { useState, useCallback, useEffect } from 'react';
import axios from 'axios';
import Swal from 'sweetalert2';
import PropTypes from 'prop-types';
const TABLE_STATUSES = [
    { value: 'libre', label: 'Libre' },
    { value: 'occupee', label: 'Occupée' },
    { value: 'reservee', label: 'Réservée' },
  ];
  