import React from "react";
import "bootstrap/dist/css/bootstrap.min.css";

const PatientForm = () => {
  return (
    <div className="container mt-4">
      <h2 className="mb-4">Personal Information</h2>
      <form>
        {/* Personal Information */}
        <div className="mb-3">
          <label htmlFor="username" className="form-label">
            User
          </label>
          <input
            type="text"
            className="form-control"
            id="username"
            defaultValue="hsadasi"
          />
        </div>

        <div className="mb-3">
          <label htmlFor="email" className="form-label">
            Email Address
          </label>
          <input
            type="email"
            className="form-control"
            id="email"
            defaultValue="sgdas@dgas.com"
          />
        </div>

        <div className="mb-3">
          <label htmlFor="phone" className="form-label">
            Phone Number
          </label>
          <div className="input-group">
            <span className="input-group-text">+1</span>
            <input
              type="tel"
              className="form-control"
              id="phone"
              defaultValue="2321413341343"
            />
          </div>
        </div>

        <div className="mb-3">
          <label htmlFor="dob" className="form-label">
            Date of Birth
          </label>
          <input
            type="date"
            className="form-control"
            id="dob"
            defaultValue="2024-11-24"
          />
        </div>

        <div className="mb-3">
          <label className="form-label">Gender</label>
          <div>
            <div className="form-check">
              <input
                type="radio"
                className="form-check-input"
                name="gender"
                id="male"
              />
              <label htmlFor="male" className="form-check-label">
                Male
              </label>
            </div>
            <div className="form-check">
              <input
                type="radio"
                className="form-check-input"
                name="gender"
                id="female"
              />
              <label htmlFor="female" className="form-check-label">
                Female
              </label>
            </div>
            <div className="form-check">
              <input
                type="radio"
                className="form-check-input"
                name="gender"
                id="other"
              />
              <label htmlFor="other" className="form-check-label">
                Other
              </label>
            </div>
          </div>
        </div>

        <div className="mb-3">
          <label htmlFor="address" className="form-label">
            Address
          </label>
          <textarea
            className="form-control"
            id="address"
            rows="2"
            defaultValue="14 street, New York, NY - 5101"
          ></textarea>
        </div>

        <div className="mb-3">
          <label htmlFor="occupation" className="form-label">
            Occupation
          </label>
          <input
            type="text"
            className="form-control"
            id="occupation"
            defaultValue="Software Engineer"
          />
        </div>

        <div className="mb-3">
          <label htmlFor="emergencyContactName" className="form-label">
            Emergency Contact Name
          </label>
          <input
            type="text"
            className="form-control"
            id="emergencyContactName"
            defaultValue="Guardian's name"
          />
        </div>

        <div className="mb-3">
          <label htmlFor="emergencyContactNumber" className="form-label">
            Emergency Contact Number
          </label>
          <input
            type="tel"
            className="form-control"
            id="emergencyContactNumber"
            defaultValue="+1 2321413341343"
          />
        </div>

        {/* Identification and Verification */}
        <h3 className="mt-4 mb-3">Identification and Verification</h3>
        <div className="mb-3">
          <label htmlFor="idType" className="form-label">
            Identification Type
          </label>
          <input
            type="text"
            className="form-control"
            id="idType"
            defaultValue="Birth Certificate"
          />
        </div>

        <div className="mb-3">
          <label htmlFor="idNumber" className="form-label">
            Identification Number
          </label>
          <input
            type="text"
            className="form-control"
            id="idNumber"
            defaultValue="123456789"
          />
        </div>

        <div className="mb-3">
          <label htmlFor="uploadDocument" className="form-label">
            Scanned Copy of Identification Document
          </label>
          <input type="file" className="form-control" id="uploadDocument" />
          <small className="form-text text-muted">
            Click to upload or drag and drop. Supported formats: SVG, PNG, JPG,
            GIF (max. 800x400px).
          </small>
        </div>

        {/* Consent and Privacy */}
        <h3 className="mt-4 mb-3">Consent and Privacy</h3>
        <div className="form-check mb-2">
          <input
            type="checkbox"
            className="form-check-input"
            id="consentTreatment"
          />
          <label htmlFor="consentTreatment" className="form-check-label">
            I consent to receive treatment for my health condition.
          </label>
        </div>

        <div className="form-check mb-2">
          <input
            type="checkbox"
            className="form-check-input"
            id="consentInfo"
          />
          <label htmlFor="consentInfo" className="form-check-label">
            I consent to the use and disclosure of my health information for
            treatment purposes.
          </label>
        </div>

        <div className="form-check mb-3">
          <input
            type="checkbox"
            className="form-check-input"
            id="agreePrivacy"
          />
          <label htmlFor="agreePrivacy" className="form-check-label">
            I acknowledge that I have reviewed and agree to the privacy policy.
          </label>
        </div>

        <button type="submit" className="btn btn-primary">
          Submit
        </button>
      </form>
    </div>
  );
};

export default PatientForm;
