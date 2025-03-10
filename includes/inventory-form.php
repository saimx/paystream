<form id="inventoryForm" class="form large-12">
    <div>
        <label for="status">Status:</label>
        <select id="status" name="status">
            <option selected value="available">Available</option>
            <option value="booked">Booked</option>
        </select>
    </div>
    
    <div>
        <label for="name">Name:</label>
        <input type="text" value="fc-23" id="name" name="name" required>
    </div>
    <div>
        <label for="size">Size:</label>
        <input type="text" value="150" id="size" name="size" required>
    </div>
    <div>
        <label for="type">Type:</label>
     
     
                                        <select id="type" name="type">
                                            <option selected value="Plot">Plot</option>
                                            <option value="Shop">Shop</option>
                                            <option value="Apartment">Apartment</option>
                                            <option value="Floor">floor</option>
                                            <option value="Outlet">Outlet</option>
                                            <option value="Plaza">Plaza</option>
                                            <option value="Building">Building</option>
                                        </select>
    </div>
    <div>
        <label for="project">Project:</label>
        <input type="text" value="pearl-one" id="project" name="project" required>
    </div>
    <div>
        <label for="code">Code:</label>
        <input type="text"  value="FC-ABS-001"  id="code" name="code">
    </div>
    <div>
        <label for="booking_date">Booking Date:</label>
        <input type="date" value="01-05-2023" id="booking_date" name="booking_date">
    </div>
    
    <div>
        <label for="floor">Floor:</label>
        <input type="text" value="03" id="floor" name="floor">
    </div>
    <button class="button tiny" type="submit" id="submitButton">Save</button>
</form>
