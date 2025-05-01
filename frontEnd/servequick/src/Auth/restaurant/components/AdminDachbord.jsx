import React, { useEffect, useState, useRef } from "react";
import axios from "axios";
import { Link, useNavigate } from "react-router-dom";
import { FaChartLine, FaShoppingCart, FaStore } from "react-icons/fa";
import { MdRestaurantMenu } from "react-icons/md";
import { IoMdStats } from "react-icons/io";
import Chart from "react-apexcharts";
import BASE_URL from "../apiConfig";
